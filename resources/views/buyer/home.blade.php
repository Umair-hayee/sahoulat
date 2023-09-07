@extends('layouts.buyer-app')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
    }

    .prof-hr hr{
      background-color: #c50000;
      height: 2px;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }
</style>
@section('content')
    <section>
        <div class="main-banner grid grid-cols-3 mx-auto mt-4">
            <div class="mb-content col-span-2 flex items-center  justify-center px-14">
                <div class="">
                    <h1 class="text-5xl font-bold text-font-color">Find the perfect <span
                            class="text-primary-color">freelance</span> services for your business</h1>
                            {{-- SEARCH GIG FIELD --}}
                    <div class="mt-8">
                        <form id="serach-gig-form" class="flex w-full">
                            <input type="text" id="search-gig" name="search_gig"
                                class="bg-[#F5F5F5] w-[80%] py-3 pl-2 rounded-tl-md rounded-bl-md">
                            <button
                                class="bg-[#C50000] text-white px-5 rounded-tr-md rounded-br-md text-xl" type="button" onclick="searchGig(event)">Search</button>
                        </form>
                    </div>
                    {{-- SEARCH BY TAGS --}}
                    <div class="tags flex mt-5">
                        {{-- <span class="font-medium">Tags:</span> --}}
                        <div class="tags-content flex">
                            @foreach($totalTags as $totalTag)
                                <div class="dropdown inline-block relative">
                                    <button class="ring-font-color ring-1 px-3 rounded-full mx-2" id="" onclick="">
                                        <span class="">{{$totalTag->name}}</span>
                                    </button>
                                    <ul class="dropdown-menu absolute hidden w-[250px] pt-2 pb-2 ml-2">
                                        @foreach($totalTag->subTags as $subTag)
                                            <li class="">
                                                <a
                                                    id="next-tags-{{$subTag->id}}"
                                                    onclick="subTagSearch({{$subTag->id}})"
                                                    class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                    href="Javascript:void(0)">{{$subTag->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-image col-span-1 flex flex-end justify-end">
                <img src="{{asset('assets/imgs/main-banner.png')}}" class="" alt="">
            </div>
        </div>
    </section>
    <section>
        <div class="main-banner grid grid-cols-4 mx-auto mt-10 flex max-w-7xl nav justify-between mx-auto">
            <div class="col-span-4">
                <div class="bg-[#F5F5F5] pt-2 pb-4 rounded-md mx-4">
                    <div class="mx-10 flex justify-between">
                        <div class="mt-4">

                            <ul class="flex gap-x-5">
                                <li class="">
                                    <p type="button">
                                        <span id="searched-text" class="text-xl font-medium text-[#C50000]">Result For
                                            "Search"</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- GIG SECTION --}}
                <div class="mt-5 mx-5">
                    <div class="grid grid-cols-8 gap-3" id="searched-gigs">
                        @if($gigs)
                            @foreach($gigs as $gig)
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
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function searchGig(event){
            event.preventDefault();
            var formdata = new FormData($('#serach-gig-form')[0])
            var searchGigText = $('#search-gig').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/buyer/search-gig",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    $('#searched-gigs').html(response);
                    if(searchGigText !== ''){
                        $('#searched-text').text("Result for "+searchGigText+"");
                    } else {
                        $('#searched-text').text("Result for Search");
                    }
                },
            });
        }

        function getGigsByTagId(tagId){
            var anchorText = $('#first-three-tag-'+tagId).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/buyer/tag/"+tagId+"/search-gig",
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    $('#searched-gigs').html(response);
                    if(anchorText !== ''){
                        $('#searched-text').text("Result(s) for "+anchorText+"");
                    } else {
                        $('#searched-text').text("Result(s) for Search");
                    }
                },
            });
        }

        function nextGigsByTagId(tagId)
        {
            var anchorText = $('#next-tags-'+tagId).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/buyer/tag/"+tagId+"/search-gig",
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    $('#searched-gigs').html(response);
                    if(anchorText !== ''){
                        $('#searched-text').text("Result(s) for "+anchorText+"");
                    } else {
                        $('#searched-text').text("Result(s) for Search");
                    }
                },
            });
        }

        function subTagSearch(id)
        {
            var anchorText = $('#next-tags-'+id).text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/buyer/tag/"+id+"/search-gig",
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    $('#searched-gigs').html(response);
                    if(anchorText !== ''){
                        $('#searched-text').text("Result(s) for "+anchorText+"");
                    } else {
                        $('#searched-text').text("Result(s) for Search");
                    }
                },
            });
        }

    </script>
@endpush

