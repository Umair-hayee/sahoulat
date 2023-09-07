<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfession;
use App\Models\UserLanguage;
use App\Models\UserSkill;
use App\Models\UserEducation;
use App\Models\UserCertificate;

class ProfileController extends Controller
{
    public function addDescription(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $user->updateOrCreate([
            'id' => auth()->user()->id
        ], [
            'description' => $request->description
        ]);
        return response()->json(['success' => true]);
    }

    public function addProfession(Request $request)
    {
        $this->validate($request, [
            'profession' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        UserProfession::updateOrCreate([
            'user_id' => $user->id,
        ],[
            'profession' => $request->profession
        ]);
        return response()->json(['success' => true]);
    }

    public function addLanguage(Request $request)
    {
        $this->validate($request, [
            'language_id' => 'required',
            'proficiency_id' => 'required',
        ]);
        UserLanguage::create([
            'user_id' => auth()->user()->id,
            'language_id' => $request->language_id,
            'proficiency_id' => $request->proficiency_id
        ]);
        return redirect()->route('buyer.dashboard')->with(['success' => 'Language added successfully!']);
    }

    public function addSkill(Request $request)
    {
        $this->validate($request, [
            'skill' => 'required',
        ]);
        UserSkill::create([
            'user_id' => auth()->user()->id,
            'skill' => $request->skill,
        ]);
        return response()->json(['success' => true]);
    }

    public function addEducation(Request $request)
    {
        $this->validate($request, [
            'education' => 'required',
            'institute' => 'required',
        ]);
        UserEducation::create([
            'user_id' => auth()->user()->id,
            'education' => $request->education,
            'institute' => $request->institute
        ]);
        return response()->json(['success' => true]);
    }

    public function addCertificate(Request $request)
    {
        $this->validate($request, [
            'certificate_title' => 'required',
            'certificate_image' => 'image',
        ]);
        $userCertificate = UserCertificate::create([
            'user_id' => auth()->user()->id,
            'title' => $request->certificate_title,
        ]);
        if($request->hasFile('certificate_image')){
            $file = $request->certificate_image;
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/public/user/certificates/'.auth()->user()->id, $fileName);
            $path = explode("public", $path)[1];
            $path = '/storage' . $path;
            $userCertificate->update([
                'image' => $path
            ]);
        }
        return response()->json(['success' => true]);
    }
}
