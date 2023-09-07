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