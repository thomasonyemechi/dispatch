<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class SmsController extends Controller
{
    function send(Request $request)
    {
        return $this->sendSms('Hello this is a test message', '09037577611');

    }
}
