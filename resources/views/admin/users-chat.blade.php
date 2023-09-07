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
                <h3 class="page-title">Users Chat Detail</h3>
            </div>
        </div>
        <div class="manage-users-area mb-5">
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Chat Detail</h6>
                        </div>
                        <div class="card-body p-0 pb-3 text-center">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-light text-left">
                                        <tr>
                                            <th scope="col" class="border-0">Message ID</th>
                                            <th scope="col" class="border-0">Sender</th>
                                            <th scope="col" class="border-0">Receiver</th>
                                            <th scope="col" class="border-0">Sender Email</th>
                                            <th scope="col" class="border-0">Receiver Email</th>
                                            <th scope="col" class="border-0">Message Content</th>
                                            <th scope="col" class="border-0">Message Seen</th>
                                            <th scope="col" class="border-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @foreach ($chats as $chat)
                                            <tr>
                                                <td>{{ $chat->id }}</td>
                                                {{-- <td>
                                                    <div class="media">
                                                        <img
                                                            src="{{ isset($user->image) ? asset($user->image) : asset('assets/imgs/19.lifestyle.png') }}"
                                                            class="mr-3 rounded-circle mentor_img" alt="..."
                                                            width="40">
                                                        <div class="media-body text-left">
                                                            <h6 class="mt-0 mb-0">{{ $user->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td>{{ $chat->sender ? $chat->sender->name : 'N/A' }}</td>
                                                <td>{{ $chat->reciever ? $chat->reciever->name : 'N/A' }}</td>
                                                <td>{{ $chat->sender ? $chat->sender->email : 'N/A' }}</td>
                                                <td>{{ $chat->reciever ? $chat->reciever->email : 'N/A' }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($chat->body, 10) }}</td>
                                                <td>{{ $chat->seen ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <a href="Javascript:void(0)" data-toggle="modal" data-target="#complete-message" data-text="{{$chat->body}}"><button class="btn btn-info">View
                                                            Messgae</button>
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

    {{-- MODAL --}}
    <div class="modal fade" id="complete-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Message Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById("complete-message"));
        var openModalLinks = document.querySelectorAll('[data-target="#complete-message"]');
        openModalLinks.forEach(function (openModalLink) {
            openModalLink.addEventListener("click", function (event) {
                event.preventDefault();
                var text = openModalLink.getAttribute("data-text"); // Get the text from data-text attribute
                myModal.show();

                // Display the text in the modal content
                var modalTextElement = document.querySelector("#complete-message .modal-body p");
                if (modalTextElement) {
                    modalTextElement.textContent = text;
                }
            });
        });
    });
    </script>
@endsection
