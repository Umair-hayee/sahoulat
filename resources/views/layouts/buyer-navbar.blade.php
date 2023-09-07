<header>
    <nav>
        <div class="flex max-w-7xl nav justify-between mx-auto">
            <div class="logo mt-1">
                <a href="{{route('buyer.home')}}"><img src="{{asset('assets/imgs/Logo Sahoulatb.png')}}" alt="" class="h-16 w-16"></a>
            </div>
            <div class="nav-links flex mt-5 text-[#292929] font-medium">
                <a href="{{route('buyer.dashboard')}}" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Home</span></a>
                {{-- <a href="" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Become A
                        Seller</span></a> --}}
                @auth
                <a href="{{route('buyer.orders.index')}}" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Orders</span></a>
                <a href="/chatify" target="_blank" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Chat</span></a>
                <a href="{{route('buyer.settings.index')}}" class="mx-5 hover:bg-[#C5000040] px-3 h-8 pt-1 rounded-md"><span>Settings</span></a>
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
<script>
    function logout() {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    }
</script>
