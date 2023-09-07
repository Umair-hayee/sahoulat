@extends('layouts.my-app')
@section('content')
    <section>
        <div class="mx-12 mt-14">
            <div class="max-w-7xl mx-auto">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-[#292929]">Earnings History</h1>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <input type="text" id="search_earnings_by_status" name="search_earnings_by_status" class="bg-[#F5F5F5] py-2 pl-2 rounded-md" placeholder="Search by order status i.e Active">
                            <button type="button" onclick="searchEarnings()"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-sm font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Search</button>
                        </div>
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
                                                    Date</th>
                                                <th scope="col"
                                                    class="px-4 py-3.5 text-left text-sm font-semibold text-[#292929]">Buyer
                                                </th>
                                                <th scope="col"
                                                    class="px-4 py-3.5 text-left text-sm font-semibold text-[#292929]">
                                                    Completion Date
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Order ID
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-[#292929] sm:pr-6">
                                                    Amount (PKR)
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white" id="earnings-table">
                                            @foreach($earnings as $earning)
                                                <tr class="divide-x divide-gray-200">
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{\Carbon\Carbon::parse($earning->start_date)->format('M d, Y')}}
                                                    </td>
                                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                        {{$earning->buyer ? $earning->buyer->name : 'N/A'}}
                                                    </td>
                                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                                        {{\Carbon\Carbon::parse($earning->due_date)->format('M d, Y')}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        {{$earning->id}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        {{ucfirst($earning->status)}}
                                                    </td>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                                        {{$earning->amount}}
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
        function searchEarnings() {
            var search = $("#search_earnings_by_status").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/seller/search-earnings",
                data: {
                    'search' : search
                },
                success: function(response) {
                    $('#earnings-table').html(response); 
                },
            });
        }
    </script>
@endpush
