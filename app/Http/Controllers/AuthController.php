<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
            } elseif (auth()->user()->role == 'designer') {
                return redirect('/designer/dashboard')->with('success', 'Welcome Back');
            } elseif (auth()->user()->role == 'delivery') {
                return redirect('/delivery/dashboard')->with('success', 'Welcome Back');
            }

            abort(404);
        }

        return back()->with('error', 'Invalid Credentials, Try again!');
    }

    function customerLogin(Request $request)
    {
        Validator::make($request->all(), [
            'phone' => 'required|min:11|max:11',
        ])->validate();

        $customer = Customer::where('phone', $request->input('phone'))->first();

        if ($customer) {
            Auth::guard('customers')->login($customer);
            return redirect()->intended('/customer/orders')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid login details.');
    }

    public function customerLogout(Request $request)
    {
        Auth::guard('customers')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('customer-login'); // Redirect to the customer login page after logout
    }
}
