<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOrder;

class EarningController extends Controller
{
    public function index()
    {
        $earnings = UserOrder::where('seller_id', auth()->user()->id)->get();
        return view('earnings.index', compact('earnings'));
    }

    public function search(Request $request)
    {
        $earnings = UserOrder::where('seller_id', auth()->user()->id);
        if(!is_null($request->search)){
            $earnings = $earnings->where('status', 'LIKE', "%$request->search%");
        }
        $earnings = $earnings->get();
        return view('ajax.earnings', compact('earnings'));
    }
}
