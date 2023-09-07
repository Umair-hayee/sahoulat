<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = UserOrder::where('seller_id', auth()->user()->id)->get();
        return view('orders.index', compact('orders'));
    }

    public function searchOrders(Request $request)
    {
        $orders = UserOrder::where('seller_id', auth()->user()->id);
        if(!is_null($request->search)){
            $orders = $orders->where('status', 'LIKE', "%$request->search%");
        }
        $orders = $orders->get();
        return view('orders.ajax-order-data', compact('orders'));
    }

    public function markAsComplete($id)
    {
        $order = UserOrder::where('id', $id)->first();
        if($order && !$order->is_completed){
            $order->update([
                'is_completed' => 1,
            ]);
            $data = [
                'orderId' => $order->id,
                'gig' => $order->gig ? $order->gig->title : 'N/A',
                'startDate' => $order->start_date,
                'dueDate' => $order->due_date,
                'orderAmount' => $order->amount
            ];
            $emails = [];
            $emails = [
                [
                    'recipient' => 'admin@sahoulat.com',
                ],
                [
                    'recipient' => $order->seller->email,
                ],
                [
                    'recipient' => $order->buyer->email,
                ],
            ];
            foreach($emails as $email){
                Mail::send('emails.order-completion', ['emailData' => $data], function($message) use ($email) {
                    $message->to($email['recipient']);
                    $message->from(env('MAIL_FROM_ADDRESS', 'sahulat@gmail.com'));
                    $message->subject('Order marked completed');
                });
            }
            return redirect()->back()->with(['success' => 'Order marked successfully!']);
        } else {
            return redirect()->back()->with(['failure' => 'Order does not exists or already completed!']);
        }
    }
}
