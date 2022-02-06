@extends('layouts.profile')

@section('contentProfile')
    <!-- Modal Edit Photo Profile -->
    <div class="modal fade" id="photo{{Auth::user()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body m-0 border">
                    <span class="col-12 py-3 d-flex justify-content-center text-decoration-none text-dark">Change Profile Photo</span>
                </div>
                <form action="{{route('profile.photo', $user->id)}}" method="POST" class="modal-body m-0 border" enctype="multipart/form-data">
                    <a class="col-12 d-flex justify-content-center text-decoration-none text-primary" style="cursor: pointer" onclick="document.getElementById('upload').click()">Upload Photo</a>
                    <input type="file" style="display: none" id="upload" name="image">
                </form>
                <form action="" class="modal-body m-0 border">
                    <a class="col-12 d-flex justify-content-center text-decoration-none text-danger" style="cursor: pointer">Remove Current Photo</a>
                </form>
                <div class="modal-body m-0 border">
                    <a class="col-12 d-flex justify-content-center text-decoration-none text-dark" style="cursor: pointer" data-bs-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 d-flex flex-column text-end">
            <div class="my-3">
                <a href="#photo{{Auth::user()->id}}" data-bs-toggle="modal" class="text-decoration-none">
                    <img
                        src="{{Auth::user()->profile != null ? Auth::user()->profile->image : '-'}}"
                        alt="profile {{Auth::user()->user_name}}"
                        class="rounded-circle"
                        style="width: 40px; height: 40px;"
                    >
                </a>
            </div>
            <h5 class="fw-bold my-3">Name</h5>
            <h5 class="fw-bold my-3">Username</h5>
            <h5 class="fw-bold my-3">Website</h5>
            <h5 class="fw-bold my-3">Bio</h5>
            <h5 class="fw-bold my-3">Email</h5>
            <h5 class="fw-bold my-3">Phone Number</h5>
            <h5 class="fw-bold my-3">Date Of Birth</h5>
            <h5 class="fw-bold my-3">Gender</h5>
        </div>
        <form action="{{route('profile.update', $user->id)}}" method="POST" class="col-9 d-flex flex-column">
            @csrf
            @method('PUT')
            <div class="my-3">
                <h5 class="m-none fw-bold">{{Auth::user()->user_name}}</h5>
                <a class="text-decoration-none m-none" data-bs-toggle="modal" href="#photo{{Auth::user()->id}}">
                    Change Profile Photo
                </a>
            </div>
            <div class="form-group col-7 mb-3">
                <input name="name" placeholder="Name" type="text" class="form-control" value="{{$user->name}}" disabled>
            </div>
            <div class="form-group col-7 mb-3">
                <input name="user_name" placeholder="User Name" type="text" class="form-control" value="{{$user->user_name}}">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="website" placeholder="Website" type="text" class="form-control" value="{{$user->profile->website}}">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="bio" placeholder="Bio" type="text" class="form-control" value="{{$user->profile->bio}}">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="email" placeholder="Email" type="text" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="phone_number" placeholder="Phone Number" type="text" class="form-control" value="{{$user->profile->phone_number}}">
            </div>
            <div class="form-group col-7 mb-3">
                <input name="date_of_birth" placeholder="Date Of Birth" type="date" class="form-control" value="{{$user->profile->date_of_birth}}">
            </div>
            <div class="form-group col-7 mb-3">
                <select name="gender" class="form-control">
                    <option {{$user->profile->gender == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                    <option {{$user->profile->gender == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                    <option {{$user->profile->gender == 'Others' ? 'selected' : ''}} value="Others">Privacy</option>
                </select>
            </div>
            <div class="form-group col-7 mb-3">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
@endsection
