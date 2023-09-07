@foreach ($orders as $order)
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
                <a href="Javascript:void(0)" onclick="alreadyMarked({{$order->id}})" id="mark-complete-{{$order->id}}" class="btn btn-primary btn-sm">Mark as complete</a>
            @else 
                <a href="{{route('mark.as.complete', $order->id)}}" class="btn btn-primary btn-sm p-2 p-2 bg-green-500 ml-2 rounded-lg">Mark as complete</a>
            @endif
        </td>
    </tr>
@endforeach
