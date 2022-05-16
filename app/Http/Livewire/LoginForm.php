<?php

namespace App\Http\Livewire;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LoginForm extends Component
{
    public $form = [
        'email'   => '',
        'password'=> '',
    ];

    public function render()
    {
        return view('livewire.login-form');
    }

    public function submit(Request $request)
    {
        $this->form = [
            'email'   => 'a2@a.com',
            'password'=> 'aaaa1111',
        ];

        $this->validate([
            'form.email'    => 'required|email',
            'form.password' => 'required',
        ]);

//        dd($this->form);
//        DB::enableQueryLog();
//        dd(Auth::attempt($this->form));
        Auth::attempt($this->form);
//        $request->session()->regenerate();
//        dd(Auth::check());
//        dd( Auth::user());
//        dd($request->session());
//        dd(DB::getQueryLog()[0]);
//        dd(getSqlWithBindings(DB::getQueryLog()));
//        dd($request->expectsJson());
//        return redirect(route('home'));

        $user = User::where('email', $this->form['email'])->first();
        $tokenResult = $user->createToken('accessToken')->accessToken;
        $tokenParts = explode(".", $tokenResult);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        $request->session()->put('accessToken', $tokenResult);
        $request->session()->put('jwtHeader', $jwtHeader);
        $request->session()->put('jwtPayload', $jwtPayload);

//        session('accessToken2', $tokenResult);
//        dd($tokenResult->accessToken);
//        header("Authenticate: Negotiate");
//        header("x-accessToken: ". $tokenResult);
//        $headers = apache_request_headers();
//        dd($headers);
//        return redirect(route('home'), 200, ['Authorization' => "accessToken=".$tokenResult]);
//        return redirect(route('home'), 200, ['accessToken' => $tokenResult]);
//        return redirect(route('home'))->withInput();
        return redirect(route('home'));

//        return response()
//            ->view('livewire.home', '', 200)
//            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
//        return response('', 200)
//            ->header('Content-Type', 'text/plain');

//        $response = redirect();
//        $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
//        $response->route('home', [
//            'status_code' => 200,
//            'accessToken' => $tokenResult->accessToken
//        ]);
//        return $response;

//        return redirect()->route('home', [
//            'status_code' => 200,
//            'accessToken' => $tokenResult->accessToken
//        ]);
    }
}
