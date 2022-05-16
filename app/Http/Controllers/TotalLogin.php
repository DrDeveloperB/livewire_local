<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalLogin extends Controller
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
            $aPermissionMenu = array();
            if ($request->permissionDepth) {
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
            $request->session()->put('mauth', $request->permissionCode);

//            ddd($request->session()->all());







//            $permissionCode = $_POST['permissionCode'];
//            $auth	= $request->permissionCode;
//
//            if ( substr($permissionYn, 0,1) == 'y' ){
//                $auth	.= ",cm_list";
//                $_SESSION['ilevel']	    =' 5';
//            }
//            if ( substr($permissionYn, 1,1) == 'y' ){
//                $auth	.= ",no_list";
//                $_SESSION['ilevel']	    =' 5';
//            }
//            if ( substr($permissionYn, 2,1) == 'y' ){
//                $auth	.= ",cs_list";
//                $_SESSION['ilevel']	    =' 5';
//            }
//            if ( substr($permissionYn, 3,1) == 'y' ){
//                $auth	.= ",ps_list";
//                $_SESSION['ilevel']	    =' 7';
//            }
//            if ( substr($permissionYn, 4,1) == 'y' ){
//                $auth	.= ",ps_log";
//                $_SESSION['ilevel']	    =' 7';
//            }
//            if ( substr($permissionYn, 5,1) == 'y' ){
//                $auth	.= ",po_list";
//                $_SESSION['ilevel']	    =' 5';
//            }
//            if ( substr($permissionYn, 6,1) == 'y' ){
//                $auth	.= ",mb_list";
//                $_SESSION['ilevel']	    =' 7';
//            }
//            if ( substr($permissionYn, 7,1) == 'y' ){
//                $auth	.= ",ir_list";
//                $_SESSION['ilevel']	    =' 7';
//            }
//            if ( substr($permissionYn, 8,1) == 'y' ){
//                $auth	.= ",ad_config";
//                $_SESSION['ilevel']	    =' 7';
//            }
//            if ( substr($permissionYn, 9,1) == 'y' ){
//                $auth	.= ",bn_plan_list";
//                $_SESSION['ilevel']	    =' 7';
//            }
//
//            $_SESSION['iauth']		= $auth;




        }

        return view('total-login');
    }
}
