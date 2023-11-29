<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return redirect('/login')->with('status', 'Invalid Email or Password');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'email|unique:users',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();

        return redirect('/login')->with('status', 'You"re Successfully Registered');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
