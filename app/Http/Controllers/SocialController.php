<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo, $provider);

        auth()->login($user);

        return redirect()->to('/home');

    }

    function createUser($getInfo, $provider)
    {

        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'creation_date'=>Carbon::parse($getInfo->user['created_at']),
                'friends_count'=>$getInfo->user['friends_count'],
                'statuses_count'=>$getInfo->user['statuses_count'],
                'favourites_count'=>$getInfo->user['favourites_count'],
                'description'=>$getInfo->user['description'],
            ]);
        }
        //TODO: fix user auth passport/apiToken
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        session(['api_token' => $token]);

        return $user;
    }
}
