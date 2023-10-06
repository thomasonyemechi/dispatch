<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{   

    function customerProfile($customer_id)
    {
        $customer = Customer::findorfail($customer_id);
        return view('other.customer-profile', compact(['customer']));
    }

    function customerList()
    {
        $customers = Customer::orderby('id','desc')->paginate(25);
        return view('other.customer-list', compact(['customers']));
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
        if(!$customer)  {
            return response(['message' => 'No user with this phone number '], 404);
        }
        return response(['message' => 'User vaidate', 'customer' => $customer], 200);
    }
}
