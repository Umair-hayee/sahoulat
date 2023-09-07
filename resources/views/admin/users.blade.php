@extends('layouts.varsiti-app')
<style>
    .mentor_img {
        height: 40px;
        object-fit: cover;
        object-position: center;
    }
</style>
@section('content')
    <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">Users</h3>
            </div>
        </div>
        <div class="manage-users-area mb-5">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Users</h6>
                        </div>
                        <div class="card-body p-0 pb-3 text-center">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-light text-left">
                                        <tr>
                                            <th scope="col" class="border-0">Name</th>
                                            <th scope="col" class="border-0">Email</th>
                                            <th scope="col" class="border-0">Phone Number</th>
                                            <th scope="col" class="border-0">User Type</th>
                                            <th scope="col" class="border-0">Joined</th>
                                            <th scope="col" class="border-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <img
                                                            src="{{ isset($user->image) ? asset($user->image) : asset('assets/imgs/19.lifestyle.png') }}"
                                                            class="mr-3 rounded-circle mentor_img" alt="..."
                                                            width="40">
                                                        <div class="media-body text-left">
                                                            <h6 class="mt-0 mb-0">{{ $user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ isset($user->phone_number) ? $user->phone_number : 'N/A' }}</td>
                                                <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                                <td>{{\Carbon\Carbon::parse($user->created_at)->format('M d, Y')}}</td>
                                                <td>
                                                    @if($user->is_deactive)
                                                        <a href="Javascript:void(0)" onclick="activateUser({{$user->id}})"><button
                                                            class="btn btn-info">Activate User</button>
                                                        </a>
                                                    @else 
                                                        <a href="Javascript:void(0)" onclick="deactivateUser({{$user->id}})"><button
                                                            class="btn btn-danger">Deactivate User</button>
                                                        </a>
                                                    @endif
                                                    @php
                                                        // $cnicImagePreview = Illuminate\Support\Facades\Storage::url($user->cnic_image)$user->;
                                                        $cnicImagePreview = asset($user->cnic_image);
                                                        
                                                    @endphp
                                                    <a href="Javascript:void(0)" onclick="openImageInNewTab('{{ $cnicImagePreview }}')"><button
                                                        class="btn btn-info">CNIC Image</button>
                                                    </a>
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

@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function deactivateUser(id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Deactivate User',
                text: 'Are you sure you want to deactivate this user?',
                allowOutsideClick: false,
                allowEscapeKey: false,
                buttons: {
                    'confirm': 'Okay',
                    'cancel' : 'Go Back'
                }
            }).then(function(isConfirm){
                if(isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "/admin/deactivate-user/"+id,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 800000,
                        success: function(response) {
                            if(response.success == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'SUCCESS...',
                                    text: 'User deactivated Successfully!',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then(function(){
                                    window.location.reload();
                                });
                            } else if(response.success == false){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            } 
                        },
                    }); 
                } 
            });
        }

        function activateUser(id)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Activate User',
                text: 'Are you sure you want to activate this user?',
                allowOutsideClick: false,
                allowEscapeKey: false,
                buttons: {
                    'confirm': 'Okay',
                    'cancel' : 'Go Back'
                }
            }).then(function(isConfirm){
                if(isConfirm){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "/admin/activate-user/"+id,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 800000,
                        success: function(response) {
                            if(response.success == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'SUCCESS...',
                                    text: 'User activated Successfully!',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then(function(){
                                    window.location.reload();
                                });
                            } else if(response.success == false){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message,
                                })
                            } 
                        },
                    }); 
                } 
            });
        }

        function openImageInNewTab(imageUrl) {
            window.open(imageUrl, '_blank');
        }


    </script>
@endsection