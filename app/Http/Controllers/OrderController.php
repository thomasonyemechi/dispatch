<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{

    /**
     * Create a new order
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function createOrder(Request $request)
    {
        Validator::make($request->all(), [
            'phone' => ['required', 'string'],
            'service_name' => ['required', 'string'],
            'receiver_phone' => ['required', 'string', 'min:11', 'max:14'],
            'receiver_address' => ['required', 'string'],
            'receiving_date' => ['required', 'date'],
            'total_price' => ['required', 'int'],
        ], [
            'phone.required' => 'Customer phone number is required',
            'receiver_phone.required' => 'Receiver phone number is required',
            'receiver_phone.min' => 'Receiver phone number is not valid',
            'receiver_phone.max' => 'Receiver phone number is not valid',
            'receiver_address.required' => 'Receiver address is required',
            'receiving_date.required' => 'Receiving date is required',
            'total_price.required' => 'Total price is required',
        ])->validate();

        try {
        $fileNames = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Generate a unique file name
                $fileName = uniqid($request->phone . '_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('orders'), $fileName);
                $fileNames[] = $fileName;
            }
        }


        $customer = Customer::updateOrCreate([
            'phone' => $request->phone
        ], [
            'name' => $request->name ?? 'Customer ' . $request->phone,
            'address' => $request->customer_address ?? 'null',
            'email' => $request->email ?? 'dummy_' . $request->phone . '@gmail.com',
            'created_by' => Auth::guard()->user()->id
        ]);

        $order = Order::query()->create([
            'customer_id' => $customer->id,
            'service_name' => $request->service_name,
            'files' => json_encode($fileNames),
            'receiver_address' => $request->receiver_address,
            'receiver_phone' => $request->receiver_phone,
            'total_price' => $request->total_price,
            'advance_paid' => $request->advance_paid ?? 0,
            'receiving_date' => $request->receiving_date,
            'created_by' => Auth::guard()->user()->id,
        ]);

        $message = 'Congratulations! Your order ' . $request->service_name . ' of ₦' . number_format($request->total_price) . ', has been created. follow to track your order Thank you for your continued patronage and support! ';
        $this->sendSms($message, $request->phone);

        } catch (\Exception $exception) {
            \Log::emergency("File: " . $exception->getFile() . " Line: " . $exception->getLine() . " Message: " . $exception->getMessage());
            return back()->with('error', 'Something went wrong, try again');
        }
        return redirect('/staff/order/'.$order->id)->with('success', 'Order Created Successfully');
    }


    public function createOrderIndex()
    {
        $designers = User::where('role', 'graphics')->select(["id", "name"])->get();
        return view('other.orders.create-order', compact('designers'));
    }

    public function viewOrders()
    {
        $orders = Order::with(relations: ['customer', 'designer', 'staff'])->where(['created_by' => auth()->user()->id ])->orderBy('id', 'desc')->paginate(25);
        return view('other.orders.orders-list', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::with(relations: ['customer', 'designer', 'staff', 'dispatcher'])->findOrFail($id);
        $dispatch_riders = User::where(['role' => 'dispatch', 'status' => 1])->limit(100)->orderby('updated_at', 'desc')->get();
        return view('other.orders.order-profile', compact(['order', 'dispatch_riders']));
    }


    function updateDispatchRider(Request $request)
    {


        Validator::make($request->all(), [
            'rider_id' => 'required|integer|exists:users,id',
            'order_id' => 'required|integer|exists:orders,id'
        ])->validate();

        Order::where('id', $request->order_id)->update([
            'dispatch_id' => $request->rider_id
        ]);

        return back()->with('success', 'Rider has been assigned to this order');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        Validator::make($request->all(), [
            'status' => ['required', 'int', 'in:1,2,3,4,5'],
        ])->validate();

        try {
            $order = Order::findOrFail($id);
            $order->status = $request->status;
            $order->save();
        } catch (\Exception $e) {
            Log::emergency("File: " . $e->getFile() . " Line: " . $e->getLine() . " Message: " . $e->getMessage());
            return back()->with('error', 'Something went wrong, try again');
        }
        return back()->with('success', 'Order status updated successfully');
    }
}
