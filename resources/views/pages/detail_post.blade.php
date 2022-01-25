@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="" class="text-decoration-none">
                        <img
                            src="{{$post->user != null ? $post->user->profile->image : '-'}}"
                            alt="profile {{$post->user->user_name}}"
                            class="rounded-circle"
                            style="width: 45px; height: 45px;"
                            >
                    </a>
                    <a class="text-decoration-none ms-1" href="">
                        <span class="mr-5 text-xl fw-bold">{{$post->user->user_name}}</span>
                        <span class="mr-5 text-sm text-dark">{{$post->user->name}}</span>
                    </a>

                </div>

                <div class="card-body">

                    <div class="col-12">
                        <img class="col-12" src="{{asset('post/'.$post->image)}}" alt="image">
                    </div>

                    <div class="mt-3 mb-3">
                        <span class="fs-5 d-block fw-bold">{{$post->category->name}}</span>
                        <b class="text-xl fw-bold">{{$post->user->user_name}}</b>&nbsp;&nbsp;<span>{{$post->title}}</span>&nbsp;
                    </div>
                    <div class="mb-1">
                        <a href="" class="text-decoration-none">
                            <img
                                src="{{$post->user->profile != null ? $post->user->profile->image : '-'}}"
                                alt="profile {{$post->user->user_name}}"
                                class="rounded-circle"
                                style="width: 35px; height: 35px;"
                                >
                        </a>
                        <a class="text-decoration-none ms-1" href="">
                            <span class="mr-5 text-xl fw-bold">{{$post->user->user_name}}</span>
                        </a>
                        <span class="ms-2 fw-bold">{!!$post->desc!!}</span>
                        <p class="fs-6 fst-italic fw-lighter text-secondary">{{$post->created_at}}</p>
                    </div>
                    @foreach ($post->comments as $comment)
                        <div class="mb-1">
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
                            <p class="fs-6 fst-italic fw-lighter text-secondary">{{$comment->created_at}}</p>
                        </div>
                    @endforeach

                    <form action="{{route('comment.update', $post->id)}}" method="POST" class="mt-3">
                        @csrf
                        @method('PUT')
                        <input type="text" class="form-control" autocomplete="off" placeholder="Add a comment" name="comment">
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="comment{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title" id="staticBackdropLabel">
                                        <a href="" class="text-decoration-none">
                                            <img
                                                src="{{$post->user->profile != null ? $post->user->profile->image : '-'}}"
                                                alt="profile {{$post->user->user_name}}"
                                                class="rounded-circle"
                                                style="width: 45px; height: 45px;"
                                                >
                                        </a>
                                        <a class="text-decoration-none ms-1" href="">
                                            <span class="mr-5 text-xl fw-bold">{{$post->user->user_name}}</span>
                                            <span class="mr-5 text-sm text-dark">{{$post->user->name}}</span>
                                        </a>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between col-12 m-0">
                                        <div class="col-6">
                                            <img class="col-12" src="{{$post->image}}" alt="image">
                                        </div>
                                        <div class="col-6 d-flex flex-column justify-content-between">
                                            <div class="ms-3 overflow-scroll" style="height: 400px">
                                                <div class="mb-2">
                                                    <a href="" class="text-decoration-none">
                                                        <img
                                                            src="{{$post->user->profile != null ? $post->user->profile->image : '-'}}"
                                                            alt="profile {{$post->user->user_name}}"
                                                            class="rounded-circle"
                                                            style="width: 35px; height: 35px;"
                                                            >
                                                    </a>
                                                    <a class="text-decoration-none ms-1" href="">
                                                        <span class="mr-5 text-xl fw-bold">{{$post->user->user_name}}</span>
                                                    </a>
                                                    <span class="ms-2">{!!$post->desc!!}</span>
                                                    <p class="text-sm text-secondary">{{$post->created_at}}</p>
                                                </div>
                                                @foreach ($post->comments as $comment)
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
                                            <form action="{{route('comment.update', $post->id)}}" method="POST" class="ms-3">
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
            </div>
        </div>
    </div>
</div>
@endsection
