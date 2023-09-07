<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = UserOrder::where('buyer_id', auth()->user()->id)->get();
        return view('buyer.orders.index', compact('orders'));
    }

    public function searchOrders(Request $request)
    {
        $orders = UserOrder::where('buyer_id', auth()->user()->id);
        if(!is_null($request->search)){
            $orders = $orders->where('status', 'LIKE', "%$request->search%");
        }
        $orders = $orders->get();
        return view('buyer.orders.ajax-order-data', compact('orders'));
    }
}
