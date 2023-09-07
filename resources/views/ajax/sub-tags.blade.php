<label for="title" class="block text-sm font-medium text-gray-700">Sub Type</label>
<div class="mt-1">
    <select name="sub_tag_id" id="sub_tag-id"
        class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Sub Type</option>
        @foreach ($subTags as $subtag)
            <option value="{{$subtag->id}}" >{{$subtag->name}}</option>
        @endforeach
    </select>
</div>