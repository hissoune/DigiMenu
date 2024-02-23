<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;

class providerController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();

    }
    public function callback($provider){

        $socialuser = Socialite::driver($provider)->user();
        //  dd($socialuser);

        $user = User::updateOrCreate([
            'provider_id' => $socialuser->id,
            'provider' => $provider,
        ], [
            'name' => $socialuser->name,
            'username' => User::GenerateUsername($socialuser->nickname),
            'email' => $socialuser->email,
            'provider_token' => $socialuser->token,
            'email_verified_at' => null, 
        ]);
    
     
        // Notification::send($user, new VerifyEmailNotification($user));
        $user->assignRole('user');
        event(new Registered($user));

        Auth::login($user);
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}