<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.change_password', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $user = User::findOrFail($id);

        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|min:5|max:20|confirmed',
        ]);

        if ($request->password && $request->oldPassword) {
            $hashedPassword = $user->password;
            if (Hash::check($request->oldPassword, $hashedPassword)) {
                if (!Hash::check($request->password, $hashedPassword)) {
                    $data['password'] = Hash::make($request->password);

                    $user->update($data);
                } else {
                    return back()->with('message', 'Kata sandi baru tidak bisa jadi kata sandi lama!');
                }
            } else {
                return back()->with('message', 'Kata sandi lama tidak cocok');
            }
        }

        $user->update($data);

        return redirect()->route('passwordProfile.show', $id)->with('update-password-success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
