<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
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
}
