<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Home | Sahoulat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .login-right {
            height: 100vh;
            background-image: url(/assets/imgs/Rectangle\ 10.png);
        }

        .nav-links {
            z-index: 99999;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <nav>
            <div class="flex max-w-7xl nav justify-between mx-auto">
                <div class="logo mt-1">
                    <a href=""><img src="{{ asset('assets/imgs/Logo Sahoulatb.png') }}" alt=""
                            class="h-16 w-16"></a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section>
            <div class="grid grid-cols-2 mx-auto -mt-[68px]">
                <div class="col-span-1 mt-[100px] mx-14">
                    <div class="mt-4">
                        <span class="text-[#292929] text-4xl font-semibold">Welcome Back</span>
                    </div>

                    <div class="">
                        <span class="text-[#575757] text-base font-normal">Welcome back! Please enter your
                            details</span>
                    </div>
                    <form method="POST" action="/login" class="w-[80%]">
                        @csrf
                        <div class="mt-4">
                            <input type="email" name="email" placeholder="Enter Email"
                                class="bg-[#F5F5F5] w-full py-3 pl-2 rounded-md">
                                @if($errors->has('email'))
                                    <div class="error" style="color: red; font-style:italic; font-weight:bold">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                        </div>
                        <div class="mt-4">
                            <input type="password" name="password" placeholder="Enter Password"
                                class="bg-[#F5F5F5] w-full py-3 pl-2 rounded-md">
                                @if($errors->has('password'))
                                    <div class="error" style="color: red; font-style:italic; font-weight:bold">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                        </div>
                        <div class="mt-4">
                            <span><a href="{{ route('password.request') }}"
                                    class="text-[#C50000] font-medium text-lg">Forget Password?</a></span>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="w-full bg-[#C50000] py-3 text-white font-medium rounded-md">
                                Sign In
                            </button>
                        </div>
                    </form>
                    <div class="w-[80%] mt-4">
                        <div class="flex mt-4">
                            <a href="{{ route('google.redirect') }}"
                                class="flex ring-1 w-full justify-center ring-[#D9D9D9] py-3 rounded-md">
                                <span class="">Sign in with </span>
                                <span class="ml-1 font-medium">
                                    <span class="text-[#4885ED]">G</span><span class="text-[#DB3236]">o</span><span
                                        class="text-[#F4C20D]">o</span><span class="text-[#4885ED]">g</span><span
                                        class="text-[#3CBA54]">l</span><span class="text-[#DB3236]">e</span>
                                </span>
                            </a>
                        </div>
                        <div class="mt-4">
                            <span class="text-[#575757] text-base font-normal">Don't have an account? <a
                                    href="{{ route('register') }}"> <span class="text-[#C50000]"> Sign
                                        Up</span></a></span>
                        </div>
                    </div>
                </div>

                <div class="col-span-1 login-right">
                    <div class="nav-links flex mt-5 text-white font-medium justify-center">
                        <a href="/home"
                            class="mx-5 hover:bg-text-hover px-3 h-8 pt-1 rounded-md"><span>Home</span></a>
                        <a href="" class="mx-5 hover:bg-text-hover px-3 h-8 pt-1 rounded-md"><span>Become A
                                Seller</span></a>
                        <a href=""
                            class="mx-5 hover:bg-text-hover px-3 h-8 pt-1 rounded-md"><span>About</span></a>
                        <a href="/login" class="mx-5 hover:bg-text-hover px-3 h-8 pt-1 rounded-md"><span>Sign
                                In</span></a>
                        <a href="/register" class="mx-5 hover:bg-text-hover px-3 h-8 pt-1 rounded-md"><span>Sign
                                Up</span></a>

                    </div>

                    <div class="flex justify-center items-center">
                        <img src="{{ asset('assets/imgs/Group 2372.png') }}" class="w-[80%]" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
