@extends('layouts.app')

@push('style')
    <style>
        .relative {
            position: relative;
        }
        .overlay {
            position: absolute;
            height: 1000px;
            width: 1000px;
            opacity: 0;
            bottom: 0px;
        }
        .overlay:hover {
            opacity: 0.5;
            height: 1000px;
            width: 1000px;
            position: absolute;
            bottom: 0px;
            background: black
        }
    </style>
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between">
                <div class="col-3">
                    <a href="">
                        <img class="col-10 rounded-circle" src="{{$user->profile->image}}" alt="profile {{$user->name}}">
                    </a>
                </div>
                <!-- Modal Pengaturan -->
                <div class="modal fade" id="pengaturan{{Auth::user()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body m-0">
                                <a class="col-12 d-flex justify-content-center text-decoration-none text-dark" style="cursor: pointer" data-bs-dismiss="modal">Change Password</a>
                            </div>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" class="modal-body m-0">
                                <a class="col-12 d-flex justify-content-center text-decoration-none text-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer">Logout</a>
                            </form>
                            <div class="modal-body m-0">
                                <a class="col-12 d-flex justify-content-center text-decoration-none text-dark" style="cursor: pointer" data-bs-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="d-flex mb-3 align-items-center">
                        <h2 class="fw-bold me-3">{{$user->user_name}}</h2>
                        <a href="{{route('profile.show', $user->id)}}" class="btn btn-warning me-3">Edit Profile</a>
                        <a href="#pengaturan{{Auth::user()->id}}" data-bs-toggle="modal" class="text-decoration-none text-dark"><i class="fas fa-cog fs-3"></i></a>
                    </div>
                    <div class="d-flex mb-3 align-items-center">
                        <h5 class="fs-5 me-5"><span class="fw-bold">{{$posts->count()}}</span> posts</h5>
                        <h5 class="fs-5"><span class="fw-bold">{{$posts->count()}}</span> Friends</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <h5 class="fs-4 fw-bold">{{$user->name}}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <h5 class="">{!!$user->profile == null ? '' : $user->profile->bio && $user->profile->bio == null ? '' : $user->profile->bio!!}</h5>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <!-- Posts -->
            <div class="col-md-12 row">

                @foreach ($posts as $data)
                    <div class="col-md-4">
                        <div style="height: 250px; width: 100%; overflow: hidden;">
                            <a href="#comment{{$data->id}}" data-bs-toggle="modal" class="relative d-flex justify-content-between">
                                <div class="overlay"></div>
                                <img src="{{asset('post/'.$data->image)}}" alt="image">
                            </a>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="comment{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title" id="staticBackdropLabel">
                                            <a href="" class="text-decoration-none">
                                                <img
                                                    src="{{$data->user->profile != null ? $data->user->profile->image : '-'}}"
                                                    alt="profile {{$data->user->user_name}}"
                                                    class="rounded-circle"
                                                    style="width: 45px; height: 45px;"
                                                >
                                            </a>
                                            <a class="text-decoration-none ms-1" href="">
                                                <span class="mr-5 text-xl fw-bold">{{$data->user->user_name}}</span>
                                                <span class="mr-5 text-sm text-dark">{{$data->user->name}}</span>
                                            </a>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between col-12 m-0">
                                            <div class="col-6">
                                                <img class="col-12" src="{{asset('post/'.$data->image)}}" alt="image">
                                            </div>
                                            <div class="col-6 d-flex flex-column justify-content-between">
                                                <div class="ms-3 overflow-scroll" style="height: 400px">
                                                    <div class="mb-2">
                                                        <a href="" class="text-decoration-none">
                                                            <img
                                                                src="{{$data->user->profile != null ? $data->user->profile->image : '-'}}"
                                                                alt="profile {{$data->user->user_name}}"
                                                                class="rounded-circle"
                                                                style="width: 35px; height: 35px;"
                                                                >
                                                        </a>
                                                        <a class="text-decoration-none ms-1" href="">
                                                            <span class="mr-5 text-xl fw-bold">{{$data->user->user_name}}</span>
                                                        </a>
                                                        <span class="ms-2">{!!$data->desc!!}</span>
                                                        <p class="text-sm text-secondary">{{$data->created_at}}</p>
                                                    </div>
                                                    @foreach ($data->comments as $comment)
                                                        <div class="mb-2">
                                                            <a href="" class="text-decoration-none">
                                                                <img
                                                                    src="{{$comment->user->profile != null ? $comment->user->profile->image : '-'}}"
                                                                    alt="profile {{$comment->user->user_name}}"
                                                                    class="rounded-circle"
                                                                    style="width: 35px; height: 35px;"
                                                                    >
                                                            </a>
                                                            <a class="text-decoration-none ms-1" href="">
                                                                <span class="mr-5 text-xl fw-bold">{{$comment->user->user_name}}</span>
                                                            </a>
                                                            <span class="ms-2">{{$comment->comment}}</span>
                                                            <p class="text-sm text-secondary">{{$comment->created_at}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <form action="{{route('comment.update', $data->id)}}" method="POST" class="ms-3">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" class="form-control" autocomplete="off" placeholder="Add a comment" name="comment">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Footer -->
            <div class="col-md-12 d-flex justify-content-center mt-5">
                <p class="text-secondary fs-6 fw-lighter">&copy;&nbsp;{{date('Y')}}&nbsp;Fitur Chat Mengechat Meta</p>
            </div>

        </div>
    </div>
</div>

@endsection
