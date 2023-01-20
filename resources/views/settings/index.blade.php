@extends('layouts.my-app')
@section('content')
    <section>
        <div class="mx-12 mt-14">
            <a href="javascript:void(0)" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md text-[#C50000] hidden" onclick="logout()"><span>Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <div class="grid grid-cols-4 gap-x-3 max-w-7xl mx-auto">
                <div class="col-span-1">
                    <div class="pt-5 flex">
                        <ul class="">
                            <li class="mb-2">
                                <a href="javascript:void(0)" onclick="changeToAccountTab()">
                                    <span class="text-[#292929] font-medium account-color">
                                        Account
                                    </span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="javascript:void(0)" onclick="changeToSecurityTab()">
                                    <span class="text-[#D9D9D9] font-medium security-color">
                                        Security
                                    </span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="javascript:void(0)" onclick="changeToNotificationTab()">
                                    <span class="text-[#D9D9D9] font-medium notification-color">
                                        Notificatoin
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-3">
                    @if(Session::has('success'))
                        <div class="mx-5 mb-3 mt-3">
                            <p class="alert alert-info shadow-lg">{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="mx-5 mb-3 mt-3">
                            <p class="alert alert-error shadow-lg">{{ Session::get('error') }}</p>
                        </div>
                    @endif
                    {{-- ACCOUNT TAB --}}
                    <div class="bg-[#F5F5F5] rounded-md pt-5 pb-5 mx-5" id="account-tab">
                        <div class="flex justify-end px-8">
                            <span class="text-[1.5vw] font-medium">Need to update your public profile? <a href="">
                                    <span class="text-[#C50000]">Go to My Profile</span></a> </span>
                        </div>
                        <div class="prof-hr mx-4 mt-2">
                            <hr>
                        </div>
                        <div class="mt-4 mx-5">
                            <form action="{{route('store.profile.settings')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Profile Picture</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="file" name="image" class="w-full py-2 pl-2 rounded-md">
                                        @if ($errors->has('image'))
                                            <div class="text-red-500 font-bold-500 italic">
                                                {{ $errors->first('image') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Location (City, Country)</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" name="location" placeholder="Enter Location"
                                            class="w-full py-2 pl-2 rounded-md">
                                        @if ($errors->has('location'))
                                            <div class="text-red-500 font-bold-500 italic">
                                                {{ $errors->first('location') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Full Name</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" name="name" placeholder="Enter Full Name"
                                            class="w-full py-2 pl-2 rounded-md">
                                        @if ($errors->has('name'))
                                            <div class="text-red-500 font-bold-500 italic">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2 mr-10">
                                        <span class="text-[#575757] font-medium">Online Status</span> <br>
                                        <span class="text-[#292929] text-xs">When online, your Gigs are visible under the
                                            Online search filter</span>
                                    </div>
                                    <div class="col-span-2">
                                        <select name="" id="" class="w-full py-2 pl-2 rounded-md">
                                            <option value="" selected>Go Offline for 2hrs</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button class="bg-[#C50000] text-white py-2 px-5 rounded-md" type="submit">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>

                        <div class="prof-hr mx-4 mt-5">
                            <hr>
                        </div>

                        <div class="mt-4 mx-5">
                            <form id="deactivate-form">
                                <div class="grid grid-cols-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">ACCOUNT DEACTIVATION</span>
                                    </div>
                                    <div class="col-span-2 pt-1">
                                        <span class="text-[#575757] font-medium text-sm">What happens when you deactivate
                                            your account?</span>
                                        <ul class="text-[#575757] font-medium text-xs ml-5 mb-4 list-disc">
                                            <li>
                                                Your profile and Gigs won't be shown anymore.
                                            </li>
                                            <li>
                                                Active orders will be cancelled.
                                            </li>
                                            <li>
                                                You won't be able to re-activate your Gigs.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2 mr-10">
                                        <span class="text-[#575757] font-medium">I am leaving beacuse ...</span> <br>
                                    </div>
                                    <div class="col-span-2">
                                        <select name="reason" id="reason" class="w-full py-2 pl-2 rounded-md">
                                            <option value="" disabled selected>Choose a reason</option>
                                            <option value="Other">Other</option>
                                            <option value="Personal">Personal</option>
                                        </select>
                                        <div class="error text-red-500 font-bold-500 italic" id="reason-error">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button class="bg-[#C50000] text-white py-2 px-5 rounded-md" onclick="saveReasonToLeave()" type="button">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- SECURITY TAB --}}
                    <div class="bg-[#F5F5F5] rounded-md pt-5 pb-5 mx-5 hidden" id="security-tab">
                        <div class="flex justify-start px-8">
                            <span class="text-[1.5vw] font-medium">Set <a href=""> <span
                                        class="text-[#C50000]">password</span></a> </span>
                        </div>
                        <div class="prof-hr mx-4 mt-2">
                            <hr>
                        </div>
                        <div class="mt-4 mx-5">
                            <form id="set-password-form">
                                @csrf
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Enter Password</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="password" name="old_password" id="old_password" placeholder="Enter Your Current Password"
                                            class="w-full py-2 pl-2 rounded-md">
                                        <div class="error text-red-500 font-bold-500 italic" id="old_password-error">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">New Password</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="password" name="new_password" id="new_password" placeholder="Enter New Password"
                                            class="w-full py-2 pl-2 rounded-md">
                                            <div class="error text-red-500 font-bold-500 italic" id="new_password-error">
                                            </div>    
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Confirm New Password</span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Enter New Password"
                                            class="w-full py-2 pl-2 rounded-md">
                                            <div class="error text-red-500 font-bold-500 italic" id="new_password_confirmation-error">
                                            </div>  
                                        <span class="text-[#575757] font-medium text-xs mt-2">8 characters or
                                            longer. Combine upper and lowercase letters and numbers.</span>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-3">
                                    <button class="bg-[#C50000] text-white py-2 px-5 rounded-md" type="button" onclick="setPassword()">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="prof-hr mx-4 mt-5">
                            <hr>
                        </div>
                        <div class="mt-4 mx-5">
                            <form action="">
                                <div class="grid grid-cols-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium">Phone Verification</span>
                                    </div>

                                    <div class="col-span-2">
                                        <input type="text" placeholder="Enter your number to verify"
                                            class="w-full py-2 pl-2 rounded-md">
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2 mr-10">
                                        <span class="text-[#575757] font-medium">Two Factor Authentication</span>
                                        <br>
                                        <span class="text-[#C50000] font-medium ">Recommended</span>
                                    </div>
                                    <div class="col-span-2 mt-1">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-[#c50000] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#C50000]">
                                            </div>
                                        </label>
                                        <br>
                                        <span class="text-xs font-medium text-[#575757] "> To help keep your account
                                            secure, we'll ask you to submit a code when using a new device to log
                                            in. We'll send the code via SMS, email, or Sahoulat notification.</span>

                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button class="bg-[#C50000] text-white py-2 px-5 rounded-md" type="submit">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- NOTIFICATION TAB --}}
                    <div class="bg-[#F5F5F5] rounded-md pt-5 pb-5 mx-5 hidden" id="notification-tab">
                        <div class="flex justify-start px-8">
                            <span class="text-[1.5vw] font-medium">Notifications</span>
                        </div>
                        <div class="prof-hr mx-4 mt-2">
                            <hr>
                        </div>
                        <div class="mt-4 mx-5">
                            <form id="email-first-section">
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] text-xs font-medium">For important updates
                                            regarding your activity, certain notifications cannot be
                                            disabled.</span>
                                    </div>
                                    <div class="col-span-2 mt-1">
                                        <div class="flex justify-between mx-14">
                                            <div class="">
                                                <span class="text-[#575757] text-sm font-medium">Type</span>
                                                <ul class="text-[#575757] text-xs font-medium">
                                                    <li>Inbox Messages</li>
                                                    <li>Order Messages</li>
                                                    <li>Order Updates</li>
                                                    <li>Rating Reminders</li>
                                                </ul>
                                            </div>
                                            <div class="">
                                                <span class="text-[#575757] text-sm font-medium">
                                                    Email
                                                </span>
                                                <ul class="text-[#575757] text-xs font-medium">
                                                    <li><input type="checkbox" name="inbox_messages" id="inbox_messages" class="accent-[#C50000]"></li>
                                                    <li><input type="checkbox" name="order_messages" id="order_messages" class="accent-[#C50000]"></li>
                                                    <li><input type="checkbox" name="order_updates" id="order_updates" class="accent-[#C50000]"></li>
                                                    <li><input type="checkbox" name="rating_reminders" id="rating_reminders" class="accent-[#C50000]"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="prof-hr mx-4 mt-5">
                            <hr>
                        </div>
                        <div class="mt-4 mx-5">
                            <form action="">
                                <div class="grid grid-cols-3">
                                    <div class="col-span-1 mt-2">
                                        <span class="text-[#575757] font-medium text-lg">Real Time
                                            Notifications</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-1 mr-10">
                                        <span class="text-[#575757] font-medium text-xs">Enable/disable real-time
                                            notifications</span> <br>
                                    </div>
                                    <div class="col-span-2 mt-1">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-[#c50000] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#C50000]">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="col-span-1 mt-1 mr-10">
                                        <span class="text-[#575757] font-medium text-xs">Enable/disable Sound</span>
                                        <br>
                                    </div>
                                    <div class="col-span-2 mt-1">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-[#c50000] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#C50000]">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <button class="bg-[#C50000] text-white py-2 px-5 rounded-md" type="submit">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>

        function changeToAccountTab()
        {
            $(".account-color").addClass("text-[#292929]");
            $(".account-color").removeClass("text-[#D9D9D9]");
            $("#account-tab").removeClass("hidden");
            $("#security-tab").addClass("hidden");
            $(".security-color").addClass("text-[#D9D9D9]");
            $("#notification-tab").addClass("hidden");
            $(".notification-color").addClass("text-[#D9D9D9]");
        }

        function changeToSecurityTab()
        {
            $(".security-color").addClass("text-[#292929]");
            $(".security-color").removeClass("text-[#D9D9D9]");
            $("#security-tab").removeClass("hidden");
            $("#account-tab").addClass("hidden");
            $(".account-color").addClass("text-[#D9D9D9]");
            $("#notification-tab").addClass("hidden");
            $(".notification-color").addClass("text-[#D9D9D9]");
        }

        function changeToNotificationTab()
        {
            $(".notification-color").addClass("text-[#292929]");
            $(".notification-color").removeClass("text-[#D9D9D9]");
            $("#notification-tab").removeClass("hidden");
            $("#account-tab").addClass("hidden");
            $(".account-color").addClass("text-[#D9D9D9]");
            $("#security-tab").addClass("hidden");
            $(".security-color").addClass("text-[#D9D9D9]");
        }

        function setPassword(){
            var formdata = new FormData($('#set-password-form')[0])
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/auth/user/set-password",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    if(response.success == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'SUCCESS...',
                            text: 'Password Changed Successfully!',
                        })
                    } else if(response.success == false){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#set-password-form #'+key+'-error').text(value)
                    });
                }
            });
        }

        function saveReasonToLeave()
        {
            var formdata = new FormData($('#deactivate-form')[0])
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/auth/user/deactivate-account",
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function(response) {
                    if(response.success == true){
                        Swal.fire({
                            title: 'SUCCESS!',
                            text: "Account Deactivated Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                event.preventDefault();
                                document.getElementById('logout-form').submit();
                            }
                        })
                    } 
                },
                error: function(response) {
                    var response = JSON.parse(response.responseText);
                    $.each( response.errors, function( key, value) {
                        $('#deactivate-form #'+key+'-error').text(value)
                    });
                }
            });
        }

    </script> 
@endpush

