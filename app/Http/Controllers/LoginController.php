<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        // validate
        // check if user exists on database
        // authenticate the user
        // redirect
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }
        $request->session()->regenerate();

        return redirect('app/dashboard');
    }
}
