<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class total_login extends Controller
{
    public function index(Request $request)
    {
        if ($request->result == "ok" &&
            substr($request->secret_key, 0, 7) == 'aes-256' &&
            strlen($request->secret_key) == 20)
        {
            /**
             * 메뉴 권한 : 배열화
             * depth구조의 권한을 json형식에 직렬화하여 전달
             * 전달 받은 데이터를 디코딩시 class 와 array 존재
             */
            $permissionDepth = new Controller;
            $aPermissionMenu = array();
            if (isset($request->permissionDepth) && !empty($request->permissionDepth)) {
                $permissionDepth = json_decode($request->permissionDepth);

                if (isset($permissionDepth->json) && count($permissionDepth->json) > 0) {
                    $oCode = (array) $permissionDepth->json;
                    $aPermissionMenu = fnPermissionMenu($aPermissionMenu, $oCode);
                }
            }

            $request->session()->put('userId', $request->userId);
            $request->session()->put('userName', $request->userName);
            $request->session()->put('team', $request->team);
            $request->session()->put('permissionDepth', $request->permissionDepth);
            $request->session()->put('permissionExecute', $request->permissionExecute);
            $request->session()->put('permission', $aPermissionMenu);
            dd($request->session()->all());
        } else {
            echo "<script>alert('접근권한이 없습니다. 관리자에게 문의해주세요.'); history.back(-2);</script>";
        }

    }

    public function test(Request $request)
    {
//        dd($request->userId);
        $result = User::select('id')->where('email', $request->userId)->first();        // object, null
//        $result = User::select('id')->where('email', 'aaaaaa')->get();        // items array, empty array
//        $result = User::select('id')->where('email', 'a2@a.com')->get();
//        dd($result);
//        dd($result->isEmpty());
//        dd($result->exists());

        $user = new User();
        $user->name = $request->userName;
        $user->email = $request->userId;

        if (!$result) {
            $user->password = bcrypt($request->userId);
            $user->save();
//            $scopes = array('place-orders', 'check-status');
//            $accessToken = $user->createToken('accessToken', ['place-orders', 'check-status'])->accessToken;
//            dd($accessToken);
        } else {
//            dd($result);
            $user->id = $result->id;
//            $accessToken = $user->createToken('accessToken', ['place-orders', 'check-status'])->accessToken;
//            dd($user);
        }
        $user->password = $request->userId;

        $login = [
            'email'   => $user->email,
            'password'=> $user->password,
        ];
        Auth::attempt($login);
//        dd(Auth::user()['id']);

        $scopes = array('place-orders', 'check-status');
        $accessToken = $user->createToken('accessToken', $scopes)->accessToken;

        $client = new Client();
//        $response = $client->request('GET', '/api/user', [
//            'headers' => [
//                'Accept' => 'application/json',
//                'Authorization' => 'Bearer ' . $accessToken,
//            ],
//        ]);
//        $body = (string) $response->getBody();
//        $remoteUser = json_decode($body);
//        dd($remoteUser);

//        $data = [
//            'grant_type' => 'password',
//            'client_id' => '2',
//            'client_secret' => 'M4t3qokY6IcAiMdHFqq5gxGeuklxHgPYvX8KF78Y',
//            'username' => Auth::user()['id'],
//            'password' => $user->password,
//            'scope' => '*',
//        ];
//        $request = Request::create('/oauth/token', 'POST', $data);
//        $response = app()->handle($request);
//        dd($response);
    }
}
