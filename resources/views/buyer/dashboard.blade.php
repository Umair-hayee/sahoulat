@extends('layouts.buyer-app')
@section('content')
    <div class="mx-5 mt-3 mb-3">
        @if(Session::has('success'))
            <p class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">{{ Session::get('success') }}</p>
        @endif
    </div>
    <section>
        <div class="main-banner grid grid-cols-4 mx-auto mt-4 flex max-w-7xl nav justify-between mx-auto">
            <div class="col-span-1">
                <div class="bg-[#F5F5F5] pt-5 pb-5 rounded-md mx-4">
                    <div class="flex justify-center">
                        <div class="">
                            <img src="{{ isset($user->image) ? asset($user->image) : asset('assets/imgs/Unsplash-Avatars_0004s_0013_sirio-wSikuNio6UY-unsplash.png') }}"
                                class="w-28 ring-1 ring-[#21EB35] rounded-full p-[2px]" alt="">
                        </div>
                    </div>
                    <div class="pt-2 flex justify-center">
                        <span class="font-medium">{{$user->name}}</span>
                    </div>
                    <div class="pt-1 flex justify-center">
                        <span class="font-medium text-xs text-[#575757]">{{$user->profession ? $user->profession->profession : 'N/A'}} </span> <button type="button"
                            onclick="OpenModal_Profession()"><img src="{{ asset('assets/imgs/edit 2.png') }}"
                                class="ml-1 w-[56%]" alt=""></button>
                    </div>
                    <div class="prof-hr pt-1 mx-5 mt-2">
                        <hr class="">
                    </div>
                    <div class="flex mx-7 mt-2 justify-between">
                        <div class="flex">
                            <span><img src="{{ asset('assets/imgs/map-pin 1.png') }}" class="w-4 mt-1"
                                    alt=""></span>
                            <span class="ml-2 text-sm mt-[2px] font-medium text-[#575757]">From</span>
                        </div>
                        <div class="">
                            <span class="ml-2 text-sm mt-[2px] font-medium text-[#575757]">{{$user->location ? $user->location : 'N/A'}}</span>
                        </div>
                    </div>
                    <div class="flex mx-7 mt-1 justify-between">
                        <div class="flex">
                            <span><img src="{{ asset('assets/imgs/user 1.png') }}" class="w-4 mt-1" alt=""></span>
                            <span class="ml-2 text-sm mt-[2px] font-medium text-[#575757]">Member Since</span>
                        </div>
                        <div class="">
                            <span class="ml-2 text-sm mt-[2px] font-medium text-[#575757]">{{$user->created_at->format('M Y')}}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#F5F5F5] pt-5 pb-5 rounded-md mx-4 mt-6">
                    <div class="flex justify-between mx-5">
                        <div class="">
                            <span class="ml-2 text-sm mt-[2px] font-medium text-[#292929]">
                                Description
                            </span>
                        </div>
                        <div class="">
                            <button type="button" onclick="OpenModal_Description()">
                                <span>
                                    <img src="{{ asset('assets/imgs/edit 1.png') }}" class="w-4 mt-1" alt="">
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="mx-7">
                        @if(isset($user->description))
                            <span class="traacking-tight text-xs text-[#575757]">
                                {{$user->description}}
                            </span>
                        @else
                            <li class="mt-1 text-sm">
                                <span class="text-[#898989]">Add Description</span>
                            </li>
                        @endif
                    </div>

                    <div class="prof-hr pt-1 mx-5 mt-2">
                        <hr class="">
                    </div>

                    <div class="flex justify-between mx-5 mt-2">
                        <div class="">
                            <span class="text-sm mt-[2px] font-medium text-[#292929]">
                                Languages
                            </span>
                        </div>
                        <div class="">
                            <button type="button" onclick="OpenModal_Language()">
                                <span class="text-sm font-medium text-[#C50000]">
                                    Add New
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="mx-5 mt-2">
                        <ul>
                            @if($user->userLanguages->count() > 0)
                                @foreach($user->userLanguages as $language)
                                    <li class="mt-1 text-sm">
                                        <span class="text-[#575757]">{{$language->language ? $language->language->name : 'N/A'}}</span> <span class="text-[#898989]">-
                                            {{$language->proficiency ? $language->proficiency->name : 'N/A'}}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="mt-1 text-sm">
                                    <span class="text-[#898989]">Add Language(s)</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="prof-hr pt-1 mx-5 mt-2">
                        <hr class="">
                    </div>

                    <div class="flex justify-between mx-5 mt-2">
                        <div class="">
                            <span class="text-sm mt-[2px] font-medium text-[#292929]">
                                Skills
                            </span>
                        </div>
                        <div class="">
                            <button type="button" class="" onclick="OpenModal_Skill()">
                                <span class="text-sm font-medium text-[#C50000]">
                                    Add New
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap w-full gap-2 mx-5 mt-2">
                        @if($user->userSkills->count() > 0)
                            @foreach($user->userSkills as $skill)
                                <span class="whitespace-nowrap text-xs p-1.5 rounded-full ring-1 ring-[#575757]">
                                    {{$skill ? $skill->skill : 'N/A'}}</span>
                            @endforeach
                        @else
                            <li class="mt-1 text-sm">
                                <span class="text-[#898989]">Add Skill(s)</span>
                            </li>
                        @endif
                    </div>

                    <div class="prof-hr pt-1 mx-5 mt-2">
                        <hr class="">
                    </div>

                    <div class="flex justify-between mx-5 mt-2">
                        <div class="">
                            <span class="text-sm mt-[2px] font-medium text-[#292929]">
                                Education
                            </span>
                        </div>
                        <div class="">
                            <button type="button" class="" onclick="OpenModal_Education()">
                                <span class="text-sm font-medium text-[#C50000]">
                                    Add New
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="mx-5 mt-2">
                        <ul>
                            @if($user->userEducations->count() > 0)
                                @foreach ($user->userEducations as $education)
                                    <li class="mt-1 text-sm">
                                        <span class="text-[#575757]">{{$education ? $education->education : 'N/A'}}</span>
                                    </li>
                                    <li class="mt-1 text-sm">
                                        <span class="text-[#898989]">{{$education ? $education->institute : 'N/A'}}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="mt-1 text-sm">
                                    <span class="text-[#898989]">Add Education</span>
                                </li>    
                            @endif
                        </ul>
                    </div>


                    <div class="prof-hr pt-1 mx-5 mt-2">
                        <hr class="">
                    </div>

                    <div class="flex justify-between mx-5 mt-2">
                        <div class="">
                            <span class="text-sm mt-[2px] font-medium text-[#292929]">
                                Certifications
                            </span>
                        </div>
                        <div class="">
                            <button type="button" class="" onclick="OpenModal_Certification()">
                                <span class="text-sm font-medium text-[#C50000]">
                                    Add New
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="mx-5 mt-2">
                        <ul>
                            @if($user->userCertificates->count() > 0)
                                @foreach($user->userCertificates as $certificate)
                                    <li class="mt-1 text-sm">
                                        <span class="text-[#898989]">{{$certificate ? $certificate->title : 'N/A'}}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="mt-1 text-sm">
                                    <span class="text-[#898989]">Add certifications</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-span-3">
                <div class="bg-[#F5F5F5] py-2 rounded-md mx-4">
                    <div class="mx-10 flex justify-between">
                        <div class="mt-4">
                            <ul class="flex gap-x-5">
                                <li class="">
                                    <button type="button" onclick="completedOrders()">
                                        <span class="text-xl font-medium text-[#C50000] span-active">Completed Orders</span>
                                    </button>
                                </li>
                                <li class="">
                                    <button type="button" onclick="pendingOrders()">
                                        <span class="text-xl font-medium span-pause">Pending Orders</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- ORDERS TABLE --}}
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg" id="gigs-section">
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
                                        @foreach($userOrders as $order)
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!--PROFESSION MODAL -->
    <div id="profession__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <div class="">
                        <form class="gap-4">
                            <div class="  w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Profession
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Profession()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="profession" class="block text-sm font-medium text-gray-700">Add
                                        Profession</label>
                                    <div class="mt-1">
                                        <input type="text" name="profession" id="profession" required
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Enter Profession" />
                                            <div class="error text-red-500 font-bold-500 italic" id="profession-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="ml-4 pb-4">
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button onclick="saveProfession()" type="button"
                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                            Save
                                        </button>
                                        <button onclick="CloseModal_Profession()" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm bg-primary-color focus:outline-none focus:ring-2 focus:ring-primary-color focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- DESCRIPTION MODAL --}}
    <div id="description__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <div class="">
                        <form class="gap-4">
                            <div class="  w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Description
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Description()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="session" class="block text-sm font-medium text-gray-700">Add
                                        Description</label>

                                    <textarea name="description" id="description" cols="30" rows="5"
                                        class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                        <div class="error text-red-500 font-bold-500 italic" id="description-modal-error">
                                        </div>
                                </div>
                            </div>
                            <div class="ml-4 pb-4">
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button onclick="saveDescription()" type="button"
                                        class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                        Save
                                    </button>
                                    <button onclick="CloseModal_Description()" type="button"
                                        class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm bg-primary-color focus:outline-none focus:ring-2 focus:ring-primary-color focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- LANGUAGE MODAL --}}
    <div id="language__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <div class="">
                        <form class="gap-4" method="POST" action="{{route('add.language')}}">
                            @csrf
                            <div class="w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Language
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Language()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="language_id" class="block text-sm font-medium text-gray-700">Add
                                        Language</label>
                                    <div class="mt-1">
                                        <select name="language_id" id="language_id"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="" disabled selected>Select Language</option>
                                            @foreach ($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('language_id'))
                                            <div class="text-red-500 font-bold-500 italic">
                                                {{ $errors->first('language_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="proficiency_id"
                                        class="block text-sm font-medium text-gray-700">Profiency</label>
                                    <div class="mt-1">
                                        <select name="proficiency_id" id="proficiency_id"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <option value="" disabled selected>Select Proficiency</option>
                                            @foreach ($proficiency as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('proficiency_id'))
                                            <div class="text-red-500 font-bold-500 italic">
                                                {{ $errors->first('proficiency_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4 pb-4">
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                                        <button onclick="CloseModal_Language()" type="button"
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

    {{-- SKILL MODAL --}}
    <div id="skill__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <div class="">
                        <form class="gap-4  ">
                            <div class="  w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Skill
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Skill()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="skill" class="block text-sm font-medium text-gray-700">Add
                                        Skill</label>
                                    <div class="mt-1">
                                        <input type="text" value="" name="skill" id="skill"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <div class="error text-red-500 font-bold-500 italic" id="skill-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="ml-4 pb-4">
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button onclick="saveSkill()" type="button"
                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                            Save
                                        </button>
                                        <button onclick="CloseModal_Skill()" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm bg-primary-color focus:outline-none focus:ring-2 focus:ring-primary-color focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- EDUCATION MODAL --}}
    <div id="education__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">

                    <div class="">
                        <form class="gap-4  ">
                            <div class="  w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Education
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Education()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="education" class="block text-sm font-medium text-gray-700">Add Recent
                                        Education</label>
                                    <div class="mt-1">
                                        <input type="text" value="" name="education" id="education"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <div class="error text-red-500 font-bold-500 italic" id="education-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="institute" class="block text-sm font-medium text-gray-700">Add
                                        Institute</label>
                                    <div class="mt-1">
                                        <input type="text" value="" name="institute" id="institute"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <div class="error text-red-500 font-bold-500 italic" id="institute-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="ml-4 pb-4">
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button onclick="saveEducation()" type="button"
                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                                        <button onclick="CloseModal_Education()" type="button"
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

    {{-- CERTIFICATE MODAL --}}
    <div id="certification__modal" class="relative z-10 hidden " style="z-index: 10000;" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <div class="">
                        <form class="gap-4  " id="certificate-save">
                            <div class="  w-full">
                                <div
                                    class="w-full h-12 border-b-[1px] justify-between flex items-center px-1 border-gray-200">
                                    <h1 class="font-bold text-primary-color">
                                        Add Certification
                                    </h1>
                                    <div class="gap-x-3 flex ">
                                        <i class="fa fa-times text-red-500 cursor-pointer"
                                            onclick="CloseModal_Certification()"></i>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="session" class="block text-sm font-medium text-gray-700">Add
                                        Certification Heading</label>
                                    <div class="mt-1">
                                        <input type="text" value="" name="certificate_title" id="certificate_title"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <div class="error text-red-500 font-bold-500 italic" id="certificate_title-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <label for="image" class="block text-sm font-medium text-gray-700">Add
                                        Certfication</label>
                                    <div class="mt-1">
                                        <input type="file" value="" name="certificate_image" id="certificate_image"
                                            class="mt-3 text-gray-500 block w-full ring-1 ring-gray-300 px-2 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            <div class="error text-red-500 font-bold-500 italic" id="certificate_image-modal-error">
                                            </div>
                                    </div>
                                </div>
                                <div class="ml-4 pb-4">
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button onclick="saveCertificate()" type="button"
                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-[#C50000] px-4 py-2 text-base font-medium text-white shadow-sm   focus:outline-none focus:ring-2 focus:ring-secondary-color focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                                        <button onclick="CloseModal_Certification()" type="button"
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
@push('scripts')
    <script>

        setTimeout(function() {
            $('.alert').addClass('hidden');
        }, 4000);

        function OpenModal_Profession() {
            const transport__modal = document.getElementById('profession__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Profession() {
            const transport__modal = document.getElementById('profession__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Skill() {
            const transport__modal = document.getElementById('skill__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Skill() {
            const transport__modal = document.getElementById('skill__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Description() {
            const transport__modal = document.getElementById('description__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Description() {
            const transport__modal = document.getElementById('description__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Language() {
            const transport__modal = document.getElementById('language__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Language() {
            const transport__modal = document.getElementById('language__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Education() {
            const transport__modal = document.getElementById('education__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Education() {
            const transport__modal = document.getElementById('education__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Certification() {
            const transport__modal = document.getElementById('certification__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Certification() {
            const transport__modal = document.getElementById('certification__modal');
            transport__modal.classList.add('hidden');
        }

        function OpenModal_Gig() {
            const transport__modal = document.getElementById('gig__modal');
            transport__modal.classList.remove('hidden');
        }

        function CloseModal_Gig() {
            const transport__modal = document.getElementById('gig__modal');
            transport__modal.classList.add('hidden');
        }

        function saveDescription(){
            var description = $("#description").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/description',
                type: 'post',
                dataType: 'JSON',
                data: {
                    'description': description,
                },
                success: function(response) {
                    if(response.success == true){
                        const transport__modal = document.getElementById('description__modal');
                        transport__modal.classList.add('hidden');
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Your work saved successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            backdrop: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/buyer/dashboard"
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#description__modal #'+key+'-modal-error').text(value)
                    });
                }
            });
        }

        function saveProfession(){
            var profession = $("#profession").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/profession',
                type: 'post',
                dataType: 'JSON',
                data: {
                    'profession': profession,
                },
                success: function(response) {
                    if(response.success == true){
                        const transport__modal = document.getElementById('profession__modal');
                        transport__modal.classList.add('hidden');
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Your work saved successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            backdrop: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/buyer/dashboard"
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#profession__modal #'+key+'-modal-error').text(value)
                    });
                }
            });
        }

        function saveSkill(){
            var skill = $("#skill").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/skill',
                type: 'post',
                dataType: 'JSON',
                data: {
                    'skill': skill,
                },
                success: function(response) {
                    if(response.success == true){
                        const transport__modal = document.getElementById('skill__modal');
                        transport__modal.classList.add('hidden');
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Your work saved successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            backdrop: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/buyer/dashboard"
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#skill__modal #'+key+'-modal-error').text(value)
                    });
                }
            });
        }

        function saveEducation(){
            var education = $("#education").val();
            var institute = $("#institute").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/education',
                type: 'post',
                dataType: 'JSON',
                data: {
                    'education': education,
                    'institute': institute, 
                },
                success: function(response) {
                    if(response.success == true){
                        const transport__modal = document.getElementById('education__modal');
                        transport__modal.classList.add('hidden');
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Your work saved successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            backdrop: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/buyer/dashboard"
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#education__modal #'+key+'-modal-error').text(value)
                    });
                }
            });
        }

        function saveCertificate(){
            var formdata = new FormData($('#certificate-save')[0])
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/buyer/certificate",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    if(response.success == true){
                        const transport__modal = document.getElementById('certification__modal');
                        transport__modal.classList.add('hidden');
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Your work saved successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            backdrop: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/buyer/dashboard"
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#certification__modal #'+key+'-modal-error').text(value)
                    });
                }
            });
        }

        function pendingOrders(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/pending-orders',
                type: 'GET',
                success: function(response) {
                    $('#gigs-section').html(response);
                    $(".span-pause").addClass("text-[#C50000]");
                    $(".span-active").removeClass("text-[#C50000]");
                },
            });  
        }

        function completedOrders(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/buyer/completed-orders',
                type: 'GET',
                success: function(response) {
                    $('#gigs-section').html(response);
                    $(".span-pause").removeClass("text-[#C50000]");
                    $(".span-active").addClass("text-[#C50000]");
                },
            });  
        }

    </script>
@endpush
