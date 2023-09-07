<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Language;
use App\Models\Proficiency;
use App\Models\Tag;
use App\Models\SubTag;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $languages = Language::all();
        $proficiency = Proficiency::all();
        $tags = Tag::all();
        $subtags = SubTag::all();
        return view('seller.dashboard', compact('user', 'languages', 'proficiency', 'tags', 'subtags'));
    }

    public function subTags(Request $request)
    {
        $tag = Tag::find($request->tagID);
        if($tag){
            $subTags = SubTag::where('tag_id', $tag->id)->get();
            return view('ajax.sub-tags', compact('subTags'));
        }
    }
}
