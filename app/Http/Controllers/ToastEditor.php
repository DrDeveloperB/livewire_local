<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToastEditor extends Controller
{
    public function index()
    {
        $db = DB::connection('morningletters');
        $po = $db->table('po_list')->select('po_content')->limit(1)->get();
//        ddd($po[0]->po_content);
        return view('toast-editor', ['po' => $po]);
    }
}
