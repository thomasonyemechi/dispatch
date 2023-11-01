<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatchRiderController extends Controller
{
    function Index()
    {
        return view('other.dispatch.index');
    }
}
