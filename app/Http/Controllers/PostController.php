<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DomDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('postsList', ['posts' => $posts]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create()
    {
        $post = Post::latest()->first();
//        $db = DB::connection('morningletters');
//        $post = $db->table('po_list')
//            ->select('po_title as title', 'po_content as body')
//            ->where('po_idx', 10010691)
//            ->first();

        $content = $post->body;

        /**
         * 한글 깨짐 해결
         */
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        /**
         * loadHtml 메소드 오류 해결
         * Unexpected end tag : p in Entity
         *
         * 또는 @$dom->loadHtml 방법도 가능
         *
         * LIBXML_HTML_NOIMPLIED : html, body 태그를 자동으로 추가하지 않음
         * LIBXML_HTML_NODEFDTD : doctype 태그를 자동으로 추가하지 않음
         */
        libxml_use_internal_errors(true);
        $dom = new DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');
        $appUrl = 'http://bhc1909dev.morningletters.kr';        // URL::to('/')

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');

            if (strpos($data, '/data/editor/') !== false && strpos($data, $appUrl) === false) {
                $imgLink = $appUrl . $data;
                $image->removeAttribute('src');
                $image->setAttribute('src', $imgLink);
            }
        }

        $post->body = $dom->saveHTML();

        return view('postsCreate', ['post' => $post]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $storage = Storage::disk('custom_01');

        /**
         * loadHtml 메소드 오류 해결
         * Unexpected end tag : p in Entity
         *
         * 또는 @$dom->loadHtml 방법도 가능
         */
        libxml_use_internal_errors(true);

        $content = $request->body;
//        ddd($content);
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom = new DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');

            if (strpos($data, 'data:image') !== false) {
                // 업로드 이미지
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);

                $imgData = base64_decode($data);
                $img = ImageManagerStatic::make($imgData)->encode('jpg');
                $name = date('Ymd_His_') . Str::random() . '.jpg';

                $storage->put($name, $img);
                $imgLink = $storage->url($name);

                $image->removeAttribute('src');
                $image->setAttribute('src', $imgLink);
            } else {
//                dd(URL::to('/'));
//                dd($data);
//        $url = "http://bhc1909dev.morningletters.kr/data/editor/1617857655995.jpg";
//        $contents = file_get_contents($url);
//        $name = substr($url, strrpos($url, '/') + 1);
//        $storage = Storage::disk('custom_01');
//        $storage->put($name.date('YmdHis').'.jpg', $contents);

                // 링크 이미지
                // 로컬 이미지가 아니라면 저장
                if (strpos($data, URL::to('/')) === false) {
                    $getContents = file_get_contents($data);
                    $getName = substr($data, strrpos($data, '/') + 1);
                    $name = date('Ymd_His_') . $getName;

                    $storage->put($name, $getContents);
                    $imgLink = $storage->url($name);

                    $image->removeAttribute('src');
                    $image->setAttribute('src', $imgLink);
                    $image->setAttribute('data-filename', $getName);
                }

            }

        }

        $content = $dom->saveHTML();
        $post = Post::create([
            'title' => $request->title,
            'body' => $content
        ]);
//        dd($post->toArray());

//        return $this->index();
        return redirect()->route('posts.index');
    }
}
