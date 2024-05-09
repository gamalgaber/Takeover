<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as ModelsSocialite;
use App\Models\User;
use Exception;

class SocialiteController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        try{
        $socialUser = Socialite::driver($provider)->user();

        $authUser = $this->store($socialUser, $provider);

        Auth::login($authUser);

        return redirect()->route('/');
        }catch(Exception $e){
            toastr('Error', 'error', 'Something is wrong try again');
            return redirect()->route('/login');
        }
    }

    public function store($socialUser, $provider){
        $socialAccount = ModelsSocialite::where(['provider_id' => $socialUser->getId(), 'provider_name' => $provider])->first();

        if(!$socialAccount){
            $user = User::where('email', $socialUser->getEmail())->first();

            if(!$user){
                $user = User::updateOrCreate([
                    'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                ]);
            }

            $user->socialite()->create([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken
            ]);

            return $user;
        }
        return $socialAccount->user;
    }
}
