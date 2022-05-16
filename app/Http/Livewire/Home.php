<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Home extends Component
{
    public function render(Request $request)
    {
//        $header = $request->accessToken;
//        $header = $request->all();
//        $header = $request->header();
//        $header = apache_request_headers();
        echo "<xmp>";
        print_r($request->session()->all());
        echo "</xmp>";

        return view('livewire.home');
    }
}
