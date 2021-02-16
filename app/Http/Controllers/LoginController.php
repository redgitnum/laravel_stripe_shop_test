<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            throw ValidationException::withMessages(['login_error' => 'wrong credentials']);
        }
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
