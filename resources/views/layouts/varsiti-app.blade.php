<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SAHOULAT</title>
    <meta name="description" content="A premium collection of beautiful hand-crafted Bootstrap 4 admin dashboard templates and dozens of custom components built for data-driven applications.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles/bootstrap.min.css')}}">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.3.1" href="{{asset('assets/styles/shards-dashboards.1.3.1.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/extras.1.3.1.min.css')}}">
    @yield('head')
  </head>
  @yield('styles')
  <body class="h-100">
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
      @include('admin.partials.side')
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                
              </form>
              <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item pt-2">
                    <a class="dropdown-item text-danger" href="{{route('logout')}}">
                        <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                </li>
            </ul>
              <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-sm-inline d-md-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                  <i class="material-icons">&#xE5D2;</i>
                </a>
              </nav>
            </nav>
          </div> <!-- / .main-navbar -->
          @yield('content')
        </main>
      </div>
    </div>
    <script src="{{asset('assets/scripts/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/scripts/popper.min.js')}}"></script>
    <script src="{{asset('assets/scripts/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="{{asset('assets/scripts/shards.min.js')}}"></script>
    <script src="{{asset('assets/scripts/jquery.sharrre.min.js')}}"></script>
    <script src="{{asset('assets/scripts/extras.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/scripts/shards-dashboards.1.3.1.min.js')}}"></script>
    <script src="{{asset('assets/scripts/app/app-analytics-overview.1.3.1.js')}}"></script>
    @yield('scripts')
  </body>
</html>

