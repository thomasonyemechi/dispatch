<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    function addStaff(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'address' => 'required|string',
        ])->validate();


        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $photo_name = 'admin/images/admin/' . $request->phone . '_' . time() . rand() . '.' . $img->getClientOriginalExtension();
            move_uploaded_file($img, $photo_name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(trim($request->phone)),
            'role' => strtolower($request->role),
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $photo_name ?? 'admin/images/admin/user.png',
        ]);


        return back()->with('success', 'Staff-Profile has been created!!');
    }
}
