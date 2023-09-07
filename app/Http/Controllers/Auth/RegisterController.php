<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['first_name'].' '.$data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Mail::send('emails.verify-email', [], function($message) use ($user) {
            $message->to($user->email);
            $message->from(env('MAIL_FROM_ADDRESS', 'sahulat@gmail.com'));
            $message->subject('Password Reset Link');
        });
    }

    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'cnic_image' => ['required', 'image'],
        ]);
        $role = Role::where('id', $request->role_id)->first();
        $user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // STORING CNIC IMAGE
        $file = $request->cnic_image;
        $fileName = $file->getClientOriginalName();
        $path = $file->storeAs('/public/user/cnic/'.$user->id, $fileName);
        $path = explode("public", $path)[1];
        $path = '/storage' . $path;
        $user->update([
            'cnic_image' => $path
        ]);
        $user->assignRole($role);
        $user->sendEmailVerificationNotification();
        return redirect()->route('login')->with(['success' => 'An email verification link is sent to your email address please verify your email!']);
    }

    public function confirmEmail($email)
    {
        $user = User::where('email', $email)->first();
        if($user){
            $user->update([
                'email_verified_at' => Carbon::now(),
            ]);
            Auth::login($user);
            return redirect()->route('home');
        } else {
            return redirect()->back()->with(['failure' => 'User not found!']);
        }
    }
}
