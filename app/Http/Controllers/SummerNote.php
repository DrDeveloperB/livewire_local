<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummerNote extends Controller
{
    public function index()
    {
        $db = DB::connection('morningletters');
        $po = $db->table('po_list')->select('po_content')->limit(1)->first();
//        ddd($po[0]->po_content);
        $po->po_content = $this->convertImg($po->po_content);

        $post = Post::latest()->first();
        $post->body = $this->convertImg($post->body);

        return view('summer-note', ['po' => $po, 'post' => $post]);
    }

    private function convertImg($content)
    {
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

        return $dom->saveHTML();
    }
}
