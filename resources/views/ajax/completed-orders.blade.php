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
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white" id="order-table-data">
        @foreach($completedOrders as $order)
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
            </tr>
        @endforeach
    </tbody>
</table>