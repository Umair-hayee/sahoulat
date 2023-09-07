@extends('layouts.varsiti-app')
@section('content')
<div class="main-content-container container-fluid px-4">
  <div class="page-header row no-gutters py-4">
    {{-- <div class="col-12 text-center text-sm-left mb-4 mb-sm-0">
      <h3 class="page-title">Dashboard</h3>
    </div> --}}
  </div>
  <div class="features-area mb-4">
    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-4">
            <div class="stats-small stats-small--1 card card-small h-100">
                <div class="card-header">
                    <h4 class="mb-0 text-uppercase mb-4">Total Users</h4>
                </div>
                <div class="card-body">
                    <div class="mentor-area">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase"></span>
                            <h6 class="stats-small__value count my-3">{{$usersCount}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stats-small stats-small--1 card card-small h-100">
                <div class="card-header">
                    <h4 class="mb-0 text-uppercase mb-4">Total Sellers</h4>
                </div>
                <div class="card-body">
                    <div class="mentor-area">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase"></span>
                            <h6 class="stats-small__value count my-3">{{$usersWithSellerRole}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stats-small stats-small--1 card card-small h-100">
                <div class="card-header">
                    <h4 class="mb-0 text-uppercase mb-4">Total Buyers</h4>
                </div>
                <div class="card-body">
                    <div class="mentor-area">
                        <div class="stats-small__data text-center">
                            <span class="stats-small__label text-uppercase"></span>
                            <h6 class="stats-small__value count my-3">{{$usersWithBuyerRole}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="total-sessions-area mb-4">
      <h3 class="mb-4">Total Orders ({{$ordersCount}})</h3>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="stats-small stats-small--1 card card-small h-100">
            <div class="card-body">
              <div class="mentor-area">
                <div class="stats-small__data text-center">
                  <span class="stats-small__label text-uppercase">Active Orders</span>
                  <h6 class="stats-small__value count my-3">{{$activeOrderCount}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stats-small stats-small--1 card card-small h-100">
            <div class="card-body">
              <div class="mentor-area">
                <div class="stats-small__data text-center">
                  <span class="stats-small__label text-uppercase">Pending Orders</span>
                  <h6 class="stats-small__value count my-3">{{$pendingOrderCount}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stats-small stats-small--1 card card-small h-100">
            <div class="card-body">
              <div class="mentor-area">
                <div class="stats-small__data text-center">
                  <span class="stats-small__label text-uppercase">Total Amount (PKR)</span>
                  <h6 class="stats-small__value count my-3">{{$totalAmount}}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection