<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <a href="{{route('home')}}" class="me-3 ms-2"><i class="fa fa-home text-dark fs-4"></i></a>
                    <a href="" data-bs-toggle="modal" class="me-3 ms-2"><i class="fas fa-comment-dots text-dark fs-4"></i></a>
                    <a href="#createPost" data-bs-toggle="modal" class="me-3 ms-2"><i class="text-dark fs-4 fas fa-plus-square"></i></a>
                    <a href="{{route('explode.index')}}" class="me-3 ms-2"><i class="fab fa-wpexplorer fs-4 text-dark"></i></a>

                    <!-- modal -->
                    <div class="modal fade" id="createPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{route('post.store')}}" method="POST" class="modal-content" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create new post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                @php
                                                    $categoriesNavbar = App\Models\Category::get();
                                                @endphp
                                                @foreach ($categoriesNavbar as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Descripsi</label>
                                            <textarea class="form-control" name="desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img
                                    src="{{Auth::user()->profile != null ? Auth::user()->profile->image : '-'}}"
                                    alt="profile {{Auth::user()->user_name}}"
                                    class="rounded-circle"
                                    style="width: 35px; height: 35px;"
                                    >
                                </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                            <a href="" class="dropdown-item">Profile</a>
                            <a class="dropdown-item border-top" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
