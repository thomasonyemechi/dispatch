<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function loginIndex()
    {
        return view('other.customers.login');
    }


    function orderInfo($order_id)
    {
        $order = Order::findorfail($order_id);

        if ($order->customer_id != auth('customers')->user()->id) {
            abort(404);
        }

        return view('other.customers.order-info', compact(['order']));
    }

    function customerProfile($customer_id)
    {
        $customer = Customer::findorfail($customer_id);
        return view('other.customers.customer-profile', compact(['customer']));
    }

    function myProfile()
    {
        $customer =  Auth::guard('customers')->user();
        return view('other.customers.my-profile', compact(['customer']));
    }

    function customerList()
    {
        $customers = Customer::where(['created_by' => auth()->user()->id ])->orderby('updated_at', 'desc')->paginate(25);
        return view('other.customers.customer-list', compact(['customers']));
    }


    public function addCustomer(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'phone' => 'required|min:11|max:11|unique:customers,phone',
            'address' => '',
            'email' => '',
        ])->validate();

        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'created_by' => auth()->user()->id
        ]);

        return back()->with('success', 'Customer Profile has been created!!');
    }


    function validateCustomerPhone(Request $request)
    {

        $customer = Customer::where(['phone' => $request->phone])->first();
        if (!$customer) {
            return response(['message' => 'No user with this phone number '], 404);
        }
        return response(['message' => 'User validated', 'customer' => $customer], 200);
    }

    public function viewOrders()
    {
        $customer = \Auth::guard('customers')->user();

        $customer_id = $customer->id;
        $today = Carbon::now();
        $current_orders = Order::query()
            ->where('customer_id', '=', $customer_id)
            ->whereRaw("STR_TO_DATE(receiving_date, '%Y-%m-%d') > '" . $today->toDateString() . "'")->get();

        $past_orders = Order::query()
            ->where('customer_id', '=', $customer_id)
            ->whereRaw("STR_TO_DATE(receiving_date, '%Y-%m-%d') < '" . $today->toDateString() . "'")->limit(6)->get();
        return view('other.customers.orders', compact('current_orders', 'past_orders'));

    }

    public function viewAllPastOrders()
    {
        $customer = \Auth::guard('customers')->user();
        $customer_id = $customer->id;
        $today = Carbon::now();

        $past_orders = Order::query()
            ->where('customer_id', '=', $customer_id)
            ->whereRaw("STR_TO_DATE(receiving_date, '%Y-%m-%d') < '" . $today->toDateString() . "'")->paginate(25);

        return view('other.customers.past-orders', compact('past_orders'));
    }

    public function saveSubscription(Request $request)
    {
        $customer = Auth::guard('customers')->user();

        $pushSubscription = $customer->pushSubscriptions()->updateOrCreate([
            'customer_id' => $customer->id,
        ], [
            'endpoint' => $request->input('endpoint'),
            'keys_p256dh' => $request->input('keys.p256dh'),
            'keys_auth' => $request->input('keys.auth'),
        ]);

        $customer->notify(new \App\Notifications\OrderStatusChangedNotification("Welcome to unique dispatch", "You will get all notifications"));
        return response()->json([
            'success' => true
        ]);
    }

    public function deleteSubscription(Request $request)
    {
        $userIdentifier = $request->input('userIdentifier'); // Get the user identifier from the request

        // Find and delete the push subscription record based on the user identifier
        PushSubscription::query()->where('user_identifier', $userIdentifier)->delete();

        return response()->json(['message' => 'Subscription deleted']);
    }

    public function checkSubscription(Request $request)
    {
        $userIdentifier = $request->input('userIdentifier'); // Get the user identifier from the request

        // Check if a subscription exists based on the user identifier
        $subscriptionExists = PushSubscription::query()->where('user_identifier', $userIdentifier)->exists();

        return response()->json(['exists' => $subscriptionExists]);
    }


}
