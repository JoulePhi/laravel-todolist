<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('user.login', [
            "title" => "Login"
        ]);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Your Email Or Password is Invalid');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegisterPage()
    {
        return view('user.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required',
        ]);

        if (!$validate) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Failed');
            return redirect('/register');
        }

        if (User::create($validate)) {
            Session::flash('status', 'success');
            Session::flash('message', 'Registered You Can Login Now');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Failed');
        }

        return redirect('/login');
    }
}
