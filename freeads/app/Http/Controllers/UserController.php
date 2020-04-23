<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        return view('auth.profile')->with('user', Auth::user());
    }

    public function edit()
    {
        return view('auth.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $request->session()->flash('status', 'Account profile updated');
        return redirect()->route('profile');
    }

    public function destroy()
    {
        $id = Auth::user()->id;
        User::destroy($id);
        return redirect()->route('home')->with('status', 'User has been deleted');
    }
}
