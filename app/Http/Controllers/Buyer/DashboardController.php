<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Language;
use App\Models\Proficiency;
use App\Models\UserGig;
use App\Models\Tag;
use App\Models\UserOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $languages = Language::all();
        $proficiency = Proficiency::all();
        $userOrders = UserOrder::where('is_completed', 1)->orderBy('created_at', 'desc')->get();
        return view('buyer.dashboard', compact('user', 'languages', 'proficiency', 'userOrders'));
    }

    public function home()
    {
        $firstThreeTags = Tag::take(3)->get();
        $nextTags = Tag::skip(3)->take(PHP_INT_MAX)->get();
        $gigs = UserGig::where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $totalTags = Tag::all();
        return view('buyer.home', compact('gigs', 'firstThreeTags', 'nextTags', 'totalTags'));
    }

    public function searchGig(Request $request)
    {
        $searchedGigs = UserGig::where('is_active', 1);
        if($request->search_gig != ""){
            $searchedGigs = $searchedGigs->where('description', 'like', "%$request->search_gig%");
        }
        $searchedGigs = $searchedGigs->get();
        return view('ajax.searched-gigs', compact('searchedGigs'));
    }

    public function searchGigByTag($id)
    {
        $searchedGigs = UserGig::where('is_active', 1)->where('sub_tag_id', $id)->get();
        return view('ajax.searched-gigs', compact('searchedGigs'));
    }

    public function createOrder($id)
    {
        $userGig = UserGig::find($id);
        if($userGig){
            $user = User::where('id', $userGig->user_id)->first();
            $userGigs = UserGig::where('user_id', $user->id)->get();
            return view('order', compact('userGig', 'userGigs'));
        }
    }

    public function storeOrder(Request $request)
    {
        $userGig = UserGig::find($request->gig_id);
        if($userGig){
            $userOrder = UserOrder::create([
                'seller_id' => $userGig->user_id,
                'buyer_id' => auth()->user()->id,
                'user_gig_id' => $userGig->id,
                'start_date' => \Carbon\Carbon::now(),
                'due_date' => $request->due_date,
                'status' => 'active',
                'amount' => $userGig->price,
            ]);
            if($request->has('note')){
                $userOrder->update([
                    'note' => $request->note
                ]);
            }
            return redirect()->route('buyer.orders.index')->with(['success' => 'Order Created Successfully!']);
        }
    }

    public function pendingOrders()
    {
        $pendingOrders = UserOrder::where('buyer_id', auth()->user()->id)
        ->where('due_date', '>=', \Carbon\Carbon::now())
        ->where('is_completed', 0)
        ->get();
        return view('ajax.pending-orders', compact('pendingOrders'));
    }

    public function completedOrders()
    {
        $completedOrders = UserOrder::where('buyer_id', auth()->user()->id)
        ->where('is_completed', 1)
        ->get();
        return view('ajax.completed-orders', compact('completedOrders'));
    }
}
