<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfession;
use App\Models\UserLanguage;
use App\Models\UserSkill;
use App\Models\UserEducation;
use App\Models\UserCertificate;
use App\Models\UserGig;

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
        return redirect()->route('seller.dashboard')->with(['success' => 'Language added successfully!']);
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

    public function addGig(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
            'title' => 'required',
            'price' => 'required',
            'sub_tag_id' => 'required',
        ]);
        $data = [];
        $data = [
            'title' => $request->title,
            'price' => $request->price,
            'user_id' => auth()->user()->id,
            'sub_tag_id' => $request->sub_tag_id,
        ];
        if($request->has('image')){
            $file = $request->image;
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/public/user/gigs/'.auth()->user()->id, $fileName);
            $path = explode("public", $path)[1];
            $path = '/storage' . $path;
            $data['image'] = $path;
        }
        if($request->has('description') && isset($request->description)){
            $data['description'] = $request->description;
        }
        UserGig::create($data);
        return response()->json(['success' => true]);
    }

    public function pauseGig(Request $request)
    {
        $userGig = UserGig::find($request->gigId);
        if(!$userGig){
            return response()->json(['success' => false]);
        }
        $userGig->update([
            'is_active' => 0
        ]);
        return response()->json(['success' => true]);
    }

    public function resumeGig(Request $request)
    {
        $userGig = UserGig::find($request->gigId);
        if(!$userGig){
            return response()->json(['success' => false]);
        }
        $userGig->update([
            'is_active' => 1
        ]);
        return response()->json(['success' => true]);
    }

    public function pausedGigsList()
    {
        $usergigs = UserGig::where('user_id', auth()->user()->id)
        ->where('is_active', 0)
        ->get();
        return view('ajax.paused-gigs', compact('usergigs'));
    }

    public function activeGigsList()
    {
        $usergigs = UserGig::where('user_id', auth()->user()->id)
        ->where('is_active', 1)
        ->get();
        return view('ajax.active-gigs', compact('usergigs'));
    }
}
