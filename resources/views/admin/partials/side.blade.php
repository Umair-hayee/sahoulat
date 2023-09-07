<style>
  #sidebar-titles h1 {
    color: #3d5170;
    font-weight: bold;
  }
</style>
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
  <div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
      <a class="nav-link text-nowrap px-3" href="" id="img-admin">
        <img class="user-avatar rounded-circle mr-2" src="{{asset('assets/imgs/download.jpeg')}}" alt="User Avatar"> <span class="d-none d-md-inline-block pt-2">Admin</span>
      </a>
      <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
        <div class="d-table m-auto">
        </div>
      </a>
      <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
        <i class="material-icons">&#xE5C4;</i>
      </a>
    </nav>
  </div>
  <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-search"></i>
        </div>
      </div>
    </div>
  </form>
  <div class="nav-wrapper" id="sidebar-titles">
    <a href="{{route('admin.dashboard')}}"><h1 class="main-sidebar__nav-title ">Dashboard</h1></a>
    <a href="{{route('admin.users.list')}}"><h1 class="main-sidebar__nav-title">Users</h1></a>
    <a href="{{route('admin.users.chat')}}"><h1 class="main-sidebar__nav-title">Chats</h1></a>
    <a href="{{route('admin.orders')}}"><h1 class="main-sidebar__nav-title">Orders</h1></a>
  </div>
</aside>