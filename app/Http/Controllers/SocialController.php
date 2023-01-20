<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('social_id', $user->id)->orWhere('email', $user->email)->first();
        if($findUser){
            Auth::login($findUser);
            return redirect()->route('home');
        } else {
            $randomGenerator = 
            $registerUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('sahoulat@123'),
                'social_type' => 'google', 
                'social_id' => $user->id
            ]);
            Auth::login($registerUser);
            return redirect()->route('home');
        }
    }
}
