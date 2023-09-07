<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    public function sendUserMesasge($number, $account_sid, $auth_token, $twilio_number, $message)
    {
        $account_sid = config('services.twilio.account_sid');
        $auth_token = config('services.twilio.auth_token');
        $twilio_number = config('services.twilio.sender_number');
        $otp = \random_int(100000, 999999);
        $message = "Welcome!"." ". $otp." is your VARSITI registration code. \nUse it to complete your sign up. Please do not share this code with anyone. We can't wait to see you soon! \n-Varsiti Team \nPS: Need anything? Email help@joinvarsiti.com";
        try {
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $number,
                array(
                    'from' => $twilio_number,
                    'body' => $message,
                )
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
