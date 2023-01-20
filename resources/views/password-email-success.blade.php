<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Check Email | Sahulat</title>
</head>
<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-2">
            <div class="row">
                <div class="col-lg-4 px-5">
                    <a href="#" class="pl-4 navbar-brand nav-logo text-uppercase font-weight-bold"><img src="{{asset('assets/imgs/Logo Sahoulatb.png')}}" alt="" class=""></a>
                </div>

                <div class="col-lg-8 px-5">
                    <div id="navbarSupportedContent" class="collapse navbar-collapse mt-3 mr-5">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item px-2"><a href="#" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                            <li class="nav-item px-2"><a href="#" class="nav-link">Explore</a></li>
                            <li class="nav-item px-2"><a href="#" class="nav-link">Become a Seller</a></li>
                            <li class="nav-item px-2"><a href="#" class="nav-link">About</a></li>
                            <li class="nav-item px-2"><a href="#" class="nav-link">Sign In</a></li>
                            <li class="nav-item px-2"><a href="#" class="nav-link join-link px-3">Join</a></li>

                        </ul>
                    </div>
                </div>
                <div class="">
                    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                </div>
            </div> 
        </nav>
    </header>
    <main>
        <section class="main-login">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-side-login">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('failure'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('failure') }}
                            </div>
                        @endif
                        <h1>Check your email</h1>
                        <br><br>
                        <h3>We sent a password reset link to</h3>
                        <h5 class="text-bold">{{$email}}</h5>
                        <br><br>
                        <form>
                           <button type="submit" class="login-btn btn-lg btn-block">Open Email </button>
                        </form> <br>
                        <h3>Didn't receive the email? <span><a href="{{route('resend.email.link', $email)}}"> Click to resend</a></span></h3>
                        <div class="go-back">
                            <h3><a href="/login"><img src="{{asset('assets/imgs/go-back.png')}}" alt="">  Back to Sign In</a></h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-side-login">
                        <br><br><br><br><br><br><br>
                        <div class="img-1">
                            <img src="{{asset('assets/imgs/Ellipse 1.png')}}" alt="">
                        </div>
                        <div class="img-2">
                            <img src="{{asset('assets/imgs/Ellipse 2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(window).on('scroll', function () {
                if ( $(window).scrollTop() > 10 ) {
                    $('.navbar').addClass('active');
                } else {
                    $('.navbar').removeClass('active');
                }
            });
        });
    </script>
</body>
</html>