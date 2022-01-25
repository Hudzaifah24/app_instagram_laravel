@extends('layouts.app')

@push('style')
    <style>
        .relative {
            position: relative;
        }
        .overlay {
            position: absolute;
            height: 500px;
            width: 500px;
            opacity: 0;
            top: 0;
        }
        .overlay:hover {
            opacity: 0.5;
            height: 500px;
            width: 500px;
            position: absolute;
            background: black
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 row">
            @foreach ($posts as $data)
                <div class="col-md-4">
                    <div style="height: 300px; overflow: hidden;">
                        <a href="#comment{{$data->id}}" data-bs-toggle="modal" class="relative">
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
    </div>
</div>
@endsection
