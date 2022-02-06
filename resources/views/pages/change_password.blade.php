@extends('layouts.profile')

@section('contentProfile')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-3 d-flex flex-column text-end">
            <div class="my-3">
                <a class="text-decoration-none">
                    <img
                        src="{{Auth::user()->profile != null ? Auth::user()->profile->image : '-'}}"
                        alt="profile {{Auth::user()->user_name}}"
                        class="rounded-circle"
                        style="width: 40px; height: 40px;"
                    >
                </a>
            </div>
            <h5 class="fw-bold my-3">Old Password</h5>
            <h5 class="fw-bold my-3">New Password</h5>
            <h5 class="fw-bold my-3">Confirm New Password</h5>
        </div>
        <form action="{{route('passwordProfile.update', $user->id)}}" method="POST" class="col-9 d-flex flex-column">
            @csrf
            @method('PUT')
            <div class="my-3">
                <h5 class="m-none fw-bold">{{Auth::user()->user_name}}</h5>
            </div>
            <div class="form-group col-7 mb-3 mt-4">
                <input name="oldPassword" placeholder="Old Password" type="password" required class="form-control">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="password" placeholder="New Password" type="password" required class="form-control" autocomplete="new-password">
            </div>
            <div class="form-group col-7 mb-3">
                <input placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" type="password" class="form-control">
            </div>
            <div class="form-group col-7 mb-3">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
@endsection
