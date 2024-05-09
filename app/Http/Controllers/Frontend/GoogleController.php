<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            // get the user google account
            $socialUser = Socialite::driver('google')->user();

            $registeredUser = User::where('google_id', $socialUser->id)->first();

            if(!$registeredUser){
                $user = User::updateOrCreate([
                    'google_id' => $socialUser->id,
                ],[
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make('12345'),
                    'provider_id' => $socialUser->getId(),
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                    'email_verified_at' => now()
                ]);
                Auth::login($user);

                return redirect()->route('/');
            }
            Auth::login($registeredUser);

            return redirect()->route('/');



            // if(User::where('email', $socialUser->getEmail())->exists()){
            //     return redirect()->route('/login')->withErrors(['email'=>'This email uses different method to login']);
            // }

            // $user = User::where(['provider' => $provider, 'provider_id' => $socialUser->id])->first();

            // if(!$user){
            //     $user = User::create([
            //             'name' => $socialUser->getName(),
            //             'email' => $socialUser->getEmail(),
            //             'username' => User::generateUserName($socialUser->getNickname()),
            //             'provider'=> $provider,
            //             'provider_id'=> $socialUser->getId(),
            //             'provider_token'=> $socialUser->token,
            //             'email_verified_at' => now()
            //     ]);
            // }

        } catch (Exception $e) {

            return redirect()->route('/login');
            // return response(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}


















   // $user = User::updateOrCreate([
            //     'provider_id' => $socialUser->id,
            //     'provider' => $provider
            // ], [
                // 'name' => $socialUser->name,
                // 'username' => User::generateUserName($socialUser->nickname),
                // 'email' => $socialUser->email,
                // 'provider_token' => $socialUser->token,
            // ]);
        //     $findUser = User::where('google_id', $user->getId())->first();

        //     if(!$findUser)

        //     {

                // $newUser = User::create([
                //     'name' => $user->getName(),
                //     'email' => $user->getEmail(),
                //     'google_id'=> $user->getId(),
                //     'password' => encrypt('123456dummy')
                // ]);

        //         Auth::login($newUser);

        //         return redirect()->route('/');

        //     }
        //     else
        //     {
        //         Auth::login($findUser);

        //         return redirect()->route('/');
            // }
