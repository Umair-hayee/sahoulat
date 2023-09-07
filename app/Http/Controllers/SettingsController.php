<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserNotification;

class SettingsController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('settings.index', compact('user'));
    }

    public function storeProfileSettings(Request $request)
    {
        $this->validate($request, [
            'location' => 'required',
            'image' => 'image',
        ]);
        $data = [];
        if($request->has('location') && isset($request->location)){
            $data['location'] = $request->location;
        }
        if($request->has('name') && isset($request->name)){
            $explodeName = explode(' ', $request->name);
            $data['name'] = $explodeName[0].' '.$explodeName[1];
        }
        if($request->hasFile('image') && isset($request->image)){
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/public/user/profile-image/'.auth()->user()->id, $fileName);
            $path = explode("public", $path)[1];
            $path = '/storage' . $path;
            $data['image'] = $path;
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->update($data);
        return redirect()->route('settings.index')->with(['success' => 'Profile settings updated successfully!']);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json(['success' => false, 'message' => 'Your current password does not match!']);
        }
        if (Hash::check($request->new_password, Auth::user()->password)) {
            return response()->json(['success' => false, 'message' => 'New password cannot be old password!']);
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        Auth::login($user);
        return response()->json(['success' => true, 'message' => 'Password updated successfully!']);
    }

    public function deactivateAccount(Request $request)
    {
        $request->validate([
            'reason' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $user->update([
            'is_deactive' => 1,
            'deactivate_reason' => $request->reason
        ]);
        return response()->json(['success' => true]);
    }
    
    public function inboxNotifications(Request $request)
    {
        if($request->check == "true"){
            UserNotification::updateOrCreate([
                'user_id' => auth()->user()->id,
            ],[
                'inbox_message' => 1
            ]);
        } else if($request->check == "false"){
            $userNotification = UserNotification::where('user_id', auth()->user()->id)->first();
            $userNotification->update([
                'inbox_message' => 0
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function orderNotifications(Request $request)
    {
        if($request->check == "true"){
            UserNotification::updateOrCreate([
                'user_id' => auth()->user()->id,
            ],[
                'order_messages' => 1
            ]);
        } else if($request->check == "false"){
            $userNotification = UserNotification::where('user_id', auth()->user()->id)->first();
            $userNotification->update([
                'order_messages' => 0
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function orderUpdatesNotifications(Request $request)
    {
        if($request->check == "true"){
            UserNotification::updateOrCreate([
                'user_id' => auth()->user()->id,
            ], [
                'order_updates' => 1
            ]);
        } else if($request->check == "false"){
            $userNotification = UserNotification::where('user_id', auth()->user()->id)->first();
            $userNotification->update([
                'order_updates' => 0
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function ratingReminderNotifications(Request $request)
    {
        if($request->check == "true"){
            UserNotification::updateOrCreate([
                'user_id' => auth()->user()->id,
            ],[
                'rating_reminders' => 1
            ]);
        } else if($request->check == "false"){
            $userNotification = UserNotification::where('user_id', auth()->user()->id)->first();
            $userNotification->update([
                'rating_reminders' => 0
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function notifications(Request $request)
    {
        $realTimeNotification = false;
        $sound = false;
        $user = User::where('id', auth()->user()->id)->first();
        if($request->has('real_time_notification')){
            $realTimeNotification = true;
        }
        if($request->has('sound')){
            $sound = true;
        }
        $user->update([
            'real_time_notification' => $realTimeNotification,
            'sound_enable' => $sound
        ]);
        return response()->json(['success' => true]);
    }

    public function phoneVerification(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $twoFactorCheckbox = false;
        if($request->has('two_factor')){
            $twoFactorCheckbox = true;
        }
        $user->update([
            'phone_number' => $request->phone_number,
            'two_factor_authentication' => $twoFactorCheckbox
        ]);
        return response()->json(['success' => true]);
    }
}
