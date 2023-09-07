@if($searchedGigs)
    @foreach($searchedGigs as $gig)
        @if($gig->is_active == 1)
            <div class="col-span-2">
                <div class="">
                    <div class="h-[158px] overflow-hidden">
                        <a href="{{route('order.creation', $gig->id)}}"><img src="{{ isset($gig->image) ? asset($gig->image) : asset('assets/imgs/Unsplash-Avatars_0006s_0003_richard-m-Sewc0TdvV-o-unsplash.png') }}"
                            class="w-full" alt=""></a>
                    </div>
                    <div class="bg-[#F5F5F5] h-[140px] rounded-bl-md rounded-br-md">
                        <div class="mx-5 pt-3 h-[95px]">
                            <span class="text-sm line-clamp-4">{{$gig->description ? $gig->description : 'N/A'}}</span>
                        </div>
                        <div class="flex mx-5 justify-between mt-2">
                            <span class="text-[#c50000] font-medium">Starting at <span class="font-bold"> PKR
                                {{$gig->price ? number_format($gig->price, 2, ".", ",") : 'N/A'}}</span></span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <span class="text-[#898989]">Gigs to be uploaded soon..</span>
@endif