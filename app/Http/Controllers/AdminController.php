<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function loginIndex()
    {
        return view('admin.login');
    }

    function addStaffIndex()
    {
        return view('admin.add_staff');
    }

    function dashboardIndex()
    {
        return view('admin.index');
    }


    function viewAllStaff()
    {
        $staffs = User::where('id', '>', 1)->orderby('id', 'desc')->paginate();
        return view('admin.staffs', compact('staffs'));
    }

    function staffProfileIndex($staff_id)
    {
        $staff = User::findorFail($staff_id);
        return view('admin.staff-profile', compact('staff'));
    }
}
