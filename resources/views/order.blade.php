@extends('layouts.buyer-app')
@section('content')
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

      body {
          font-family: 'Poppins', sans-serif;
      }

      .prof-hr hr {
          background-color: #c50000;
          height: 2px;
      }
  </style>
  <section>
      <div class="main-banner grid grid-cols-6 mx-auto mt-4 flex max-w-7xl nav justify-between mx-auto">
          <div class="col-span-4">
              <div class="bg-[#F5F5F5] pt-5 pl-5 pr-5  rounded-lg mx-4">
                  <div class="pt-4 font-bold text-2xl col-span-7">
                      <span class="text-sm text-[#575757] pl-5">{{$userGig->subtag ? $userGig->subtag->name : 'N/A'}}</span> <br>
                      <span class="pl-4 text-[#292929]">{{$userGig->title}}</span>
                  </div>
                  <div class="grid grid-cols-8 p-5">
                      <div class="col-span-1 flex">
                          <img src="/assets/imgs/Unsplash-Avatars_0004s_0013_sirio-wSikuNio6UY-unsplash.png"
                              class="w-20 ring-1 ring-[#21EB35] rounded-full p-[2px]" alt="">
                      </div>
                      <div class="pt-2 col-span-7">
                          <span class="font-bold text-lg text-[#292929]">{{$userGig->user ? $userGig->user->name : 'N/A'}}</span> <br>
                          <span class="text-sm text-[#575757]">
                              <div class="flex">
                                  <span>
                                      <img src="/assets/imgs/map-pin 1.png" class="w-4 mt-1" alt="">
                                  </span>
                                  <span class="ml-1 text-sm mt-[2px] font-medium text-[#575757]">{{$userGig->user ? $userGig->user->location : 'N/A'}}</span>
                              </div>
                          </span>
                      </div>
                  </div>
              </div>

              <div class="bg-[#F5F5F5] pt-5 pb-5 rounded-md mx-4 mt-6">
                  <div class="flex justify-between mx-5">
                      <div class="">
                          <span class="ml-2 text-2xl mt-[2px] font-medium text-[#292929]">
                              Description
                          </span>
                      </div>
                  </div>
                  <div class="mx-7 mt-2">
                      <span class="traacking-tight text-sm text-[#292929]">{{$userGig->description}}</span>
                  </div>

                  <div class="prof-hr pt-1 mx-5 mt-2">
                      <hr class="">
                  </div>

                  <div class="flex justify-between mx-5 mt-5">
                      <div class="">
                          <span class="ml-2 text-2xl mt-[2px] font-medium text-[#292929]">
                              Reviews
                          </span>
                      </div>
                  </div>
                  <div class="mx-7 mb-5">
                      <span class="traacking-tight text-sm text-[#292929]">Hey folks, Michael here! My contribution
                          towards graphic designing is since 2016. I can set and change trends in this industry by serving
                          you with the exceptional branding solutions. I am professional designer who visualize your
                          concept and crave it by way of design. Designing is something gives me inner satisfaction
                          because its my passion. So let's collaborate on our first project. Thanks!</span>
                  </div>

                  <div class="prof-hr pt-1 mx-5 mt-2">
                      <hr class="">
                  </div>
                  {{-- MORE GIGS --}}
                  <div class="flex justify-between mx-5 mt-5">
                      <div class="">
                          <span class="ml-2 text-2xl mt-[2px] font-medium text-[#292929]">
                              More by <span class="text-[#C50000]">SELLER</span>
                          </span>
                      </div>
                  </div>
                  <div class="mx-7 mt-3">
                      <div class="grid grid-cols-2 gap-3">
                        @if($userGigs)
                          @foreach($userGigs as $gig)
                            <div class="col-span-1">
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
                          @endforeach
                        @endif
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-span-2">
              <div class="bg-[#F5F5F5] pb-5 py-2 rounded-md mx-4">
                  <div class="mx-10 flex justify-between">
                      <div class="mt-4">
                          <ul class="flex gap-x-2">
                              <li class="">
                                    <button type="button"
                                        class="text-xl font-medium bg-[#C50000] text-white p-3 rounded-md" onclick="OpenModal_DueDateOrder()">
                                        Order Now
                                    </button>
                              </li>
                              <li class="mt-3">
                                  <a href="/chatify/{{$userGig->user_id}}"
                                        target="_blank"
                                      class="text-xl font-medium bg-[#C50000] text-white py-3 px-10 rounded-md">
                                      Chat
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>

              <div class="mt-5 mx-5">

              </div>
          </div>
      </div>
      </div>
  </section>

  {{-- ORDER DUE DATE MODAL --}}
  <div id="education__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
  role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <div
              class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
              <div class="">
                  <form class="gap-4" method="POST" action="{{route('create.order')}}">
                      @csrf
                      <input type="hidden" name="gig_id" value="{{$userGig->id}}"/>
                      <div class="w-full">
                          <div
                              class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                              <h1 class="font-bold text-primary-color">
                                  Set Due Date
                              </h1>
                              <div class="gap-x-3 flex ">
                                  <i class="fa fa-times text-red-500 cursor-pointer"
                                      onclick="CloseModal_DueDateOrder()"></i>
                              </div>
                          </div>
                          <div class="mt-5">
                              <label for="due_date" class="block text-sm font-medium text-gray-700">Set Due Date
                                  </label>
                              <div class="mt-1">
                                  <input type="date" name="due_date" id="due-date" required
                                      class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                      <div class="error text-red-500 font-bold-500 italic" id="due-date-modal-error">
                                      </div>
                              </div>
                          </div>
                          <div class="mt-5">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note (optional)
                                </label>
                            <div class="mt-1">
                                <input type="text" name="note" id="note"
                                    class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <div class="error text-red-500 font-bold-500 italic" id="due-date-modal-error">
                                    </div>
                            </div>
                        </div>
                          <div class="ml-4 pb-4">
                              <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                  <button type="submit"
                                      class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                                  <button onclick="CloseModal_DueDateOrder()" type="button"
                                      class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm bg-primary-color focus:outline-none focus:ring-2 focus:ring-primary-color focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

<script>
  function OpenModal_DueDateOrder() {
            const transport__modal = document.getElementById('education__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_DueDateOrder() {
            const transport__modal = document.getElementById('education__modal');
            transport__modal.classList.add('hidden');
        }
</script>
