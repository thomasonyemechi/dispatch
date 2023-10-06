<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    function createOrder(Request $request)
    {
        Validator::make($request->all(), [
            'phone' => 'string'
        ]);
    }


    public function createOrderIndex()
    {
        return view('other.create-order');
    }
}
