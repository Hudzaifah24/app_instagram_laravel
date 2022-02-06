<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user = User::with(['profile'])->findOrFail(Auth::user()->id);

        $posts = Post::where('user_id', Auth::user()->id)->get();

        return view('pages.profile_auth', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('pages.edit_profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $user = User::findOrFail($id);

        $profile = Profile::where('user_id', $id)->first();

        $user->update($data);

        $profile->update($data);

        return redirect()->route('profile.show', $id)->with('update-success', '');
    }

    public function photo(Request $request, $id)
    {
        $data = $request->all();

        $profile = Profile::where('user_id', $id)->first();

        $profile->update($data);

        return redirect()->route('profile.show', $id)->with('update-photo-success', '');
    }

}
