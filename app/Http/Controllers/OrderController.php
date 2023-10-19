<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            'phone' => ['required', 'string', 'exists:customers,phone'],
            'service_name' => ['required', 'string'],
            'designer' => ['exists:users,id,role,graphics', 'int'],
            'receiver_phone' => ['required', 'string', 'min:11', 'max:14'],
            'receiver_address' => ['required', 'string'],
            'receiving_date' => ['required', 'date'],
            'total_price' => ['required', 'int'],
            'advance_paid' => ['required', 'int'],
        ], [
            'phone.required' => 'Customer phone number is required',
            'phone.exists' => 'Customer phone number is not valid',
            'designer.exists' => 'Designer is not valid',
            'designer.int' => 'Designer is not valid',
            'designer.required' => 'Designer is required',
            'receiver_phone.required' => 'Receiver phone number is required',
            'receiver_phone.min' => 'Receiver phone number is not valid',
            'receiver_phone.max' => 'Receiver phone number is not valid',
            'receiver_address.required' => 'Receiver address is required',
            'receiving_date.required' => 'Receiving date is required',
            'total_price.required' => 'Total price is required',
            'advance_paid.required' => 'Advance paid is required',
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

            $customer = Customer::where('phone', $request->phone)->firstOrFail();

            Order::query()->create([
                'customer_id' => $customer->id,
                'designer_id' => $request->designer,
                'service_name' => $request->service_name,
                'files' => json_encode($fileNames),
                'receiver_address' => $request->receiver_address,
                'receiver_phone' => $request->receiver_phone,
                'total_price' => $request->total_price,
                'advance_paid' => $request->advance_paid,
                'receiving_date' => $request->receiving_date,
                'created_by' => auth()->user()->id,
            ]);

        } catch (\Exception $exception) {
            \Log::emergency("File: " . $exception->getFile() . " Line: " . $exception->getLine() . " Message: " . $exception->getMessage());
            return back()->with('error', 'Something went wrong, try again');
        }
        return back()->with('success', 'Order Created Successfully');
    }


    public function createOrderIndex()
    {
        $designers = User::where('role', 'graphics')->select(["id", "name"])->get();
        return view('other.orders.create-order', compact('designers'));
    }

    public function viewOrders()
    {
        $orders = Order::with(relations: ['customer', 'designer', 'staff'])->orderBy('id', 'desc')->paginate(25);
        return view('other.orders.orders-list', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = Order::with(relations: ['customer', 'designer', 'staff'])->findOrFail($id);
        return view('other.orders.order-profile', compact('order'));
    }
}
