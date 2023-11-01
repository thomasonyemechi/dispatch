<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function loginIndex()
    {
        return view('other.customers.login');
    }

    function customerProfile($customer_id)
    {
        $customer = Customer::findorfail($customer_id);
        return view('other.customers.customer-profile', compact(['customer']));
    }

    function customerList()
    {
        $customers = Customer::orderby('id', 'desc')->paginate(25);
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

}
