<?php

namespace App\Http\Controllers;

use App\Models\PushSubscription;
use Illuminate\Http\Request;
use App\Models\Customer;

class WebNotificationController extends Controller
{

    public function storeToken(Request $request)
    {
        auth()->guard('customers')->user()->update(['device_key' => $request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = Customer::where('id', '=', 2)->pluck('device_key')->all();

        $serverKey = "AAAALoWyYRM:APA91bHPNiHF_60QZOAbRuHH9ZZSTZ7VZ-fkCFHJrJaRN_nD-fNjgJ-IydvbDfQX3ZV9QQNU2g713NE4qCdG6xglAul_GA-o1IFq7mM5_PPMXTCGDDA3ncjeAdG0HwzODDidrA13U4pO";

        $data = [
            'registration_ids' => $FcmToken,
            'notification' => [
                'title' => "Testing Notification",
                'body' => "Hello World",
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
        //        $headers = [
        //            'Authorization' => 'key=' . $serverKey,
        //            'Content-Type' => 'application/json',
        //        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            error_log("FCM request failed: $error");
            return false;
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            error_log("FCM request returned HTTP code $httpCode");
            return false;
        }

        curl_close($ch);
        return $response;
        //        $response = Http::withHeaders($headers)
        //            ->withOptions(['verify' => false]) // Disabling SSL verification
        //            ->post($url, $encodedData);
        //
        //        if ($response->failed()) {
        //            dd($response);
        //            die('HTTP request failed with status code: ' . $response->status());
        //        }
        //
        //        $result = $response->body();

        // FCM response
        //        dd($result);
    }

    public function checkToken(Request $request)
    {
        $customer = auth()->guard('customers')->user();

        if ($customer && $customer->device_key !== null) {
            // The customer has a device token
            $tokenExists = true;
        } else {
            // The customer does not have a device token
            $tokenExists = false;
        }

        return response()->json(['exists' => $tokenExists]);
    }
}
