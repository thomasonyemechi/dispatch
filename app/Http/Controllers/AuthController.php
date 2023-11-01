<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function staffLogin(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ])->validate();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if (auth()->user()->role == 'administrator') {
                return redirect('/admin/dashboard')->with('success', 'Welcome Back');
            } elseif (auth()->user()->role == 'marketer') {
                return redirect('/staff/dashboard')->with('success', 'Welcome Back');
            }elseif (auth()->user()->role == 'dispatch') {
                return redirect('/dispatch/dashboard')->with('success', 'Welcome Back');
            }

            abort(404);
        }

        return back()->with('error', 'Invalid Credentials, Try again!');
    }
}
