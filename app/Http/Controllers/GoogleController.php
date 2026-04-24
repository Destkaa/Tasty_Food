<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('home');
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                    'name' => $user->name,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy') // password default sembarang
                ]);

                Auth::login($newUser);
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            return redirect('login');
        }
    }
}