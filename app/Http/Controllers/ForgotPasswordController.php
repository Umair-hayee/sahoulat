<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            Mail::send('emails.reset-form', [], function($message) use ($user) {
                $message->to($user->email);
                $message->from(env('MAIL_FROM_ADDRESS', 'sahulat@gmail.com'));
                $message->subject('Password Reset Link');
            });
            $email = $request->email;
            return view('password-email-success', compact('email'));
        } else {
            return redirect()->back()->with(['failure' => 'Email does not exists in our records']);
        }
    }

    public function passwordResetLinkForm()
    {
        return view('password-reset-link');
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                return redirect()->back()->with(['failure' => 'New password cannot be old password!']);
            } else {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::login($user);
                return view('password-reset-success');
            }
        } else {
            return redirect()->back()->with(['failure' => 'Please enter valid email address']);
        }
    }

    public function resendLink($email)
    {
        $user = User::where('email', $email)->first();
        if($user){
            Mail::send('emails.reset-form', [], function($message) use ($user) {
                $message->to($user->email);
                $message->from(env('MAIL_FROM_ADDRESS', 'sahulat@gmail.com'));
                $message->subject('Password Reset Link');
            });
            return redirect()->route('login')->with(['success' => 'Another link sent to your email!']);
        } else {
            return redirect()->route('login')->with(['failure' => 'Please enter valid email address!']);
        }
    }
}
