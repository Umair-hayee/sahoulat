@extends('layouts.my-app')
@section('content')
    <section>
        <div class="mx-5 mt-3 mb-3">
            @if(Session::has('success'))
                <p class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">{{ Session::get('success') }}</p>
            @endif
        </div>
        <div class="mx-5 mt-3 mb-3">
            @if(Session::has('failure'))
                <p class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{ Session::get('failure') }}</p>
            @endif
        </div>
        <div class="mx-12 mt-14">
            <div class="max-w-7xl mx-auto">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-[#292929]">Manage Orders</h1>
                        </div>
                        <form id="search-order">
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <input type="text" name="search_order" id="search_order" class="bg-[#F5F5F5] py-2 pl-2 rounded-md" placeholder="Search by order status i.e Active">
                                <button type="button" onclick="searchOrders()"
                                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr class="divide-x divide-gray-200">
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pl-6">
                                                    Buyer</th>
                                                <th scope="col"
                                                    class="px-4 py-3.5 text-left text-sm font-semibold text-[#292929]">Gig
                                                </th>
                                                <th scope="col"
                                                    class="px-4 py-3.5 text-left text-sm font-semibold text-[#292929]">Due
                                                    On</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Total</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Note</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Status</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white" id="order-table-data">
                                            @foreach($orders as $order)
                                                <tr class="divide-x divide-gray-200">
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{$order->buyer ? $order->buyer->name : 'N/A' }}
                                                    </td>
                                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                        {{$order->gig ? $order->gig->title : 'N/A'}}
                                                    </td>
                                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                        {{\Carbon\Carbon::parse($order->due_date)->format('M d, Y')}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        PKR {{$order->amount}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        {{isset($order->note) ? $order->note : 'N/A'}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        <span class="bg-yellow-400 py-1 px-4 rounded-full">{{ucfirst($order->status)}}</span>
                                                    </td>
                                                    <td>
                                                        @if($order->is_completed || $order->status == "inactive")
                                                            <a href="Javascript:void(0)" onclick="alreadyMarked({{$order->id}})" id="mark-complete-{{$order->id}}" class="btn btn-primary btn-sm p-2 bg-green-500 ml-2 rounded-lg">Mark as complete</a>
                                                        @else 
                                                            <a href="{{route('mark.as.complete', $order->id)}}" class="btn btn-primary btn-sm p-2 p-2 bg-green-500 ml-2 rounded-lg">Mark as complete</a>
                                                        @endif
                                                    </td>
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
    </section>
@endsection

@push('scripts')
    <script>
        function searchOrders() {
            var search = $("#search_order").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/seller/search-orders",
                data: {
                    'search' : search
                },
                success: function(response) {
                    $('#order-table-data').html(response); 
                },
            });
        }

        function alreadyMarked(id){
            $('#mark-complete-'+id).click(function(){
                Swal.fire({
                    title: 'Warning!',
                    text: "Order already marked as complete, or is in inactive state.",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                    backdrop: false,
                })
            })
        }
    </script>
@endpush

