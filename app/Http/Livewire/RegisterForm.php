<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request as RequestClass;
use Illuminate\Support\Str;
use Laravel\Passport\Bridge\AccessToken;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Livewire\Component;

class RegisterForm extends Component
{
    public $form = [
//        'name'                  => '',
//        'email'                 => '',
//        'password'              => '',
//        'password_confirmation' => '',
        'name'                  => 'a1',
        'email'                 => 'a1@a.com',
        'password'              => 'aaaa1111',
        'password_confirmation' => 'aaaa1111',
    ];

    public function render()
    {
        return view('livewire.register-form');
    }

    public function submit()
    {
//        $user = new User();
//        $user->id = 333;
////        $user->name = '테스트333';
////        $user->email = 'a333@a.com';
////        $user->user_id = $user->id;
//        $accessToken = $user->createToken('accessToken');
//        dd($accessToken);

//        $accessToken = $user->createToken('accessToken')->accessToken;
//        $refreshToken = $user->createToken('refreshToken')->token;
//        dd(array(
//            'accessToken' => $accessToken,
//            'refreshToken' => $refreshToken
//        ));

//        $clientClass = new ClientRepository();
//        $client = $clientClass->create(
//            $user->id,                      // 클라이언트 고유번호 (nullable)
//            $user->name,                    // 클라이언트 이름
//            'http://localhost',     // 승인 또는 허가 후 리디렉션되는 url
//            'users',                // 공급자 config/auth.php/guards/api/provider
//            1,                  // Access Token (단기 토큰 권한 부여(사용 여부))
//            1,                      // Refresh Token (장기 토큰 권한 부여(사용 여부))
//            0                       // Revoked (취소, 미사용 여부)
//        );
//        dd($client);
////        $clientClass->createPersonalAccessClient($client->id, $client->name, $client->redirect);
//        $accessClient = Passport::personalAccessClient();
//        $accessClient->client_id = $client->id;
//        $accessClient->save();
//        dd($clientClass->getPersonalAccessClientId());

//        $accessToken = new AccessToken($user->id);
//        $accessToken->setIdentifier($this->generateUniqueIdentifier());
//        $accessToken->setClient(new Client($clientId, null, null));
//        $accessToken->setExpiryDateTime((new DateTime())->add(Passport::tokensExpireIn()));
//
//        $accessTokenRepository = new AccessTokenRepository(new TokenRepository(), new Dispatcher());
//        $accessTokenRepository->persistNewAccessToken($accessToken);




        // 장기 토큰 권한 부여
//        $client = $clientClass->createPasswordGrantClient($user->id, $user->name,'http://localhost', 'users');

//        $accessToken = new AccessToken($user->id);
//        $accessToken->setIdentifier($client->secret);
//        $accessToken->setClient($client);


//        $accessClient = Passport::personalAccessClient();
//        $accessClient->client_id = $client->id;
//        $accessClient->save();
//        $client->identifier = Str::random(40);
//        dd($accessToken);

////        $user = User::where('email', 'a2@a.com')->first();
//        $accessToken = $user->createToken('accessToken')->accessToken;
//        $client->accessToken = $accessToken;
////        $refreshToken = $user->createToken('refreshToken')->token;
////        $client->refreshToken = $refreshToken;
//        dd($client);

        $this->validate([
            'form.name'     => 'required',
            'form.email'    => 'required|email',
            'form.password' => 'required|confirmed',
        ]);

        $this->form['password'] = bcrypt($this->form['password']);
//        dd($this->form);
        User::create($this->form);
        return redirect(route('loginw'));
    }

}
