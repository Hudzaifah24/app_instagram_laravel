<div class="col-3 card rounded">
    <div class="d-flex flex-column list-group">
        <a href="{{route('profile.show', Auth::user()->id)}}" class="p-3 list-group-item {{request()->is('profile/*') ? 'active' : ''}}">Change profile</a>
        <a href="{{route('passwordProfile.update', Auth::user()->id)}}" class="p-3 list-group-item {{request()->is('passwordProfile/*') ? 'active' : ''}}">Change Password</a>
        <a href="" class="p-3 list-group-item">Login Activity</a>
        <a href="" class="p-3 list-group-item">Add Post</a>
        <a href="" class="p-3 list-group-item">Friend</a>
        <a href="" class="p-3 list-group-item">Delete Conversation</a>
        <a href="" class="p-3 list-group-item">Help</a>
    </div>
</div>
