@extends('layouts.varsiti-app')
<style>
    .mentor_img {
        height: 40px;
        object-fit: cover;
        object-position: center;
    }
</style>
@section('content')
    <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">Orders</h3>
            </div>
        </div>
        <div class="manage-users-area mb-5">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0"></h6>
                        </div>
                        <div class="card-body p-0 pb-3 text-center">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-light text-left">
                                        <tr>
                                            <th scope="col" class="border-0">Order ID</th>
                                            <th scope="col" class="border-0">Seller</th>
                                            <th scope="col" class="border-0">Seller Email</th>
                                            <th scope="col" class="border-0">Buyer</th>
                                            <th scope="col" class="border-0">Buyer Email</th>
                                            <th scope="col" class="border-0">Gig Title</th>
                                            <th scope="col" class="border-0">Start Date</th>
                                            <th scope="col" class="border-0">Due Date</th>
                                            <th scope="col" class="border-0">Status</th>
                                            <th scope="col" class="border-0">Amount (PKR)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->seller ? $order->seller->name : 'N/A'}}</td>
                                                <td>{{$order->seller ? $order->seller->email : 'N/A'}}</td>
                                                <td>{{$order->buyer ? $order->buyer->name : 'N/A'}}</td>
                                                <td>{{$order->buyer ? $order->buyer->email : 'N/A'}}</td>
                                                <td>{{$order->gig ? $order->gig->title : 'N/A'}}</td>
                                                <td>{{\Carbon\Carbon::parse($order->start_date)->format('M d, Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($order->due_date)->format('M d, Y')}}</td>
                                                <td>{{ucfirst($order->status)}}</td>
                                                <td>{{$order->amount}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    </script>
@endsection