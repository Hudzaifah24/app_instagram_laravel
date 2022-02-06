@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                @include('includes.sidebar')
                <div class="col-9 card rounded">
                    @yield('contentProfile')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
