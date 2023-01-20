<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="/dist/output.css" rel="stylesheet"> --}}
    <title>Home | Sahoulat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <nav>
            <div class="flex max-w-7xl nav justify-between mx-auto">
                <div class="logo mt-1">
                    <a href=""><img src="{{asset('assets/imgs/Logo Sahoulatb.png')}}" alt="" class="h-16 w-16"></a>
                </div>
                <div class="nav-links flex mt-5 text-[#292929] font-medium">
                    <a href="/home" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Home</span></a>
                    <a href="" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Become A
                            Seller</span></a>
                    <a href="" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>About</span></a>
                    @auth
                <a href="{{route('settings.index')}}" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Settings</span></a>
                @endauth
                @auth
                    <a href="javascript:void(0)" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md text-[#C50000]" onclick="logout()"><span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="/login" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Sign In</span></a>
                    <a href="/register" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Sign Up</span></a>
                @endauth

                </div>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <div class="main-banner grid grid-cols-3 mx-auto mt-4">
                <div class="mb-content col-span-2 flex items-center  justify-center px-14">
                    <div class="">
                        <div class="mx-5 mt-3 mb-3">
                            @if(Session::has('error'))
                                <p class="alert alert-error shadow-lg">{{ Session::get('error') }}</p>
                            @endif
                        </div>
                        <h1 class="text-5xl font-bold text-[#292929]">Find the perfect <span
                                class="text-[#C50000]">freelance</span> services for your business</h1>
                        <div class="mt-8">
                            <form action="" class="flex w-full">
                                <input type="text"
                                    class="bg-[#F5F5F5] w-[80%] py-3 pl-2 rounded-tl-md rounded-bl-md">
                                <button
                                    class="bg-[#C50000] text-white px-5 rounded-tr-md rounded-br-md text-xl">Search</button>
                            </form>
                        </div>
                        <div class="tags flex mx-5 mt-5">
                            <span class="font-medium">Tags:</span>
                            <div class="tags-content flex ml-3">
                                <a href="">
                                    <span class="ring-[#292929] ring-1 px-3 rounded-full mx-2">Web Development</span>
                                </a>
                                <a href="">
                                    <span class="ring-[#292929] ring-1 px-3 rounded-full mx-2">Graphic Designer</span>
                                </a>
                                <a href="">
                                    <span class="ring-[#292929] ring-1 px-3 rounded-full mx-2">Logo Design</span>
                                </a>
                                <a href="">
                                    <span class="ring-[#292929] ring-1 px-3 rounded-full mx-2">...</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-image col-span-1 flex flex-end justify-end">
                    <img src="{{asset('assets/imgs/main-banner.png')}}" class="" alt="">
                </div>
            </div>
        </section>

        <section class="professional-services-section mb-5">
            <div class="pss-head pt-8 pb-5 flex justify-center items-center">
                <h3 class="text-[#292929] text-4xl font-medium">Popular <span
                        class="text-[#C50000]">professional</span> services</h3>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-6 gap-6 mt-3">
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/4.Web and app design.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Web & App Dev</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/18.business.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Business</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/16.Music & audio.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Music & Audio</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/17.programming & tech.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Programming</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/15.video & animation.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Video Animation</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="h-[250px] shadow-sm ring-1 ring-gray-100 pt-8 rounded-md">
                        <div class="pss-content-img flex justify-center items-center">
                            <img src="{{asset('assets/imgs/13.digital marketing.png')}}" class="w-[60%]" alt="">
                        </div>
                        <div class="pss-content-text flex justify-center items-center pt-8">
                            <span class="text-[#C50000] font-bold">Digital Marketing</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="advantages pb-20">
            <div class="flex justify-center items-center mt-20">
                <h1 class="[#292929] text-4xl font-medium">A whole world of freelance talent at your <span
                        class="text-[#C50000]">fingertips</span></h1>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-6 gap-6 mt-3">
                <div class="col-span-3">
                    <div class="grid grid-cols-3 mt-10">
                        <div class="col-span-1">
                            <span class="text-[100px] flex justify-center text-[#C5000026] font-bold">1</span>
                        </div>
                        <div class="col-span-2 mt-5">
                            <span class="text-2xl font-bold">The best for every budget</span> <br>
                            <span class="text-lg">Find high-quality services at every price point. No hourly rates,
                                just project-based pricing.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="col-span-1">
                            <span class="text-[100px] flex justify-center text-[#C5000026] font-bold">2</span>
                        </div>
                        <div class="col-span-2 mt-5">
                            <span class="text-2xl font-bold">Quality work done quickly</span> <br>
                            <span class="text-lg">Find the right freelancer to begin working on your project within
                                minutes.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="col-span-1">
                            <span class="text-[100px] flex justify-center text-[#C5000026] font-bold">3</span>
                        </div>
                        <div class="col-span-2 mt-5">
                            <span class="text-2xl font-bold">Protected payments, every time</span> <br>
                            <span class="text-lg">Always know what you'll pay upfront. Your payment isn't released
                                until you approve the work.</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 mt-14">
                    <div class="">
                        <img src="{{asset('assets/imgs/talent.jpg')}}" alt="" class="rounded">
                    </div>
                </div>
            </div>

        </section>

        <section class="marketplace pt-10 bg-[#DB000008] pb-20">
            <div class="mp-head flex justify-center pt-10 items-center">
                <h3 class="text-[#292929] text-4xl font-medium"><span class="text-[#C50000]">Explore</span> the
                    marketplace</h3>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-5 gap-6 mt-10">
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/1.Graphic designing.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Graphics & Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/13.digital marketing.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Digital Marketing</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/4.Web and app design.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Web Development</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/14.writing & translation.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Content Writing</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/22.animation for kids.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Animations</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/16.Music & audio.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Music & Audio</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/21.3D product animation.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">3D Modelling</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/18.business.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Business</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/15.video & animation.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Videography</span>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="bg-white h-[210px] shadow-lg rounded-md">
                        <div class="mp-icon flex justify-center items-center pt-5">
                            <img src="{{asset('assets/imgs/17.programming & tech.png')}}" class="w-[50%]" alt="">
                        </div>
                        <div class="mp-tag flex justify-center items-center pt-5">
                            <span class="text-xl font-medium">Programming & Tech</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="guides pb-20">
            <div class="flex justify-center items-center mt-20">
                <h1 class="[#292929] text-4xl font-medium"><span class="text-[#C50000]">Guides</span></h1>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-3 gap-6 mt-10">
                <div class="col-span-1">
                    <div class="guide-img rounded-md">
                        <img src="{{asset('assets/imgs/Rectangle 4.png')}}" alt="">
                    </div>
                    <div class="guide-des mt-4">
                        <h3 class="text-xl font-bold mb-1">Start an online business and work from home</h3>
                        <span class="text-md mt-2">A complete guide to starting a small business online.</span>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="guide-img rounded-md">
                        <img src="{{asset('assets/imgs/Rectangle 4.png')}}" alt="">
                    </div>
                    <div class="guide-des mt-4">
                        <h3 class="text-xl font-bold mb-1">Digital marketing made easy</h3>
                        <span class="text-md mt-2">A practical guide to understand what is digital marketing.</span>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="guide-img rounded-md">
                        <img src="{{asset('assets/imgs/Rectangle 4.png')}}" alt="">
                    </div>
                    <div class="guide-des mt-4">
                        <h3 class="text-xl font-bold mb-1">Create a logo for your business</h3>
                        <span class="text-md mt-2">A step-by-step guide to create a memorable business logo.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="get-started">
            <div class="gs-main bg-[#D9D9D9] h-[500px]">
                <div class="gs-text flex justify-center items-center pt-[250px]">
                    <h1 class="text-5xl font-bold text-[#292929]">Find the <span
                            class="text-[#C50000]">talent</span> needed to get your business <span
                            class="text-[#C50000]">growing</span></h1>
                </div>
                <div class="gs-button flex justify-center mt-8">
                    <a href="" class="bg-[#C50000] p-4 rounded-md text-white"><span class="text-2xl">Get
                            Started</span></a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <section class="footer pt-20">
            <div class="max-w-7xl mx-auto grid grid-cols-4 gap-6">
                <div class="col-span-1 mx-4">
                    <div class="footer-head">
                        <h3 class="text-[#C50000] font-medium text-lg">Get in touch</h3>
                    </div>
                    <div class="footer-des mt-2">
                        <span class="text-base">Follow us on social media
                            and keep in touch </span>
                        <div class="footer-social-links flex mt-3">
                            <a href="" class="mr-3"><img src="{{asset('assets/imgs/Vector-1.png')}}"
                                    alt=""></a>
                            <a href="" class="mx-3 mt-1"><img src="{{asset('assets/imgs/Vector-2.png')}}"
                                    alt=""></a>
                            <a href="" class="mx-3"><img src="{{asset('assets/imgs/group.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 mx-4">
                    <div class="footer-head">
                        <h3 class="text-[#C50000] font-medium text-lg">Customer Service</h3>
                    </div>
                    <div class="footer-des mt-2">
                        <ul class="list-none">
                            <li><a href="">Service</a></li>
                            <li><a href="">Secured Online Payments</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="footer-head">
                        <h3 class="text-[#C50000] font-medium text-lg">Help and Support</h3>
                    </div>
                    <div class="footer-des mt-2">
                        <ul class="list-none">
                            <li><a href="">Sitemap</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="footer-head">
                        <h3 class="text-[#C50000] font-medium text-lg">My Account</h3>
                    </div>
                    <div class="footer-des mt-2">
                        <ul class="list-none">
                            <li><a href="">My Account</a></li>
                            <li><a href="">Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="post-footer py-10">
                <h6 class="flex justify-center items-centrer ">Copyright © 2022 Company name Ltd. All rights reserved
                </h6>
            </div>
        </section>
    </footer>
</body>
</html>
