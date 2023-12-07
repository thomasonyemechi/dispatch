<?php

namespace App\Http\Controllers;

use App\Models\OrderLog;
use App\Models\Sms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    function sendSms($body, $to, $from = "")
    {

        $from = ($from == "") ? env('SMS_DEFAULT_SENDER') : $from;

        $sms = Sms::create([
            'phone_number' => $to,
            'body' => $body,
            'sent_by' => Auth::guard()->user()->id ?? 1
        ]);

        $res = Http::asForm()->post(env('SMS_ENDPOINT'), [
            'from' => $from,
            'to' => $to,
            'body' => $body,
            'api_token' => env("SMS_API_TOKEN"),
            'gateway' => '1',
            'append_sender' => env('SMS_DEFAULT_SENDER')
        ]);

        $res = json_decode($res);

        $sms->update([
            'status' => $res->data->status ?? 'Message was not sent'
        ]);


        return $res;
    }


    function order_log($order_id, $dept, $remark)
    {
        OrderLog::create([
            'order_id' => $order_id,
            'logged_by' => auth()->user()->id ?? 1,
            'department' => $dept,
            'remark' => $remark,
        ]);
    }



    function readME()
    {
        /** 
         * dispatch_status 
         * 0 = order has just been completed and designed by the marketer
         * 1 = order has been newly pushed for delivery 
         * 2 = produced and package 
         * 3 = sent to dispatchers for transport
         * 4 = seen by dispatcher 
         * 
         * 
         * 98 = Damaged on arrival to customer
         * 99 = Damaged on arrival to park 
         **/
    }
}
