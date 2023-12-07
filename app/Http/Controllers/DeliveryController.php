<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLog;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function index()
    {
        $pushed_to_delivery = Order::where(['dispatch_status' => 1])->count();
        $ready_for_dispatch = Order::where(['dispatch_status' => 2])->count();
        return view('other.delivery.index', compact(['pushed_to_delivery', 'ready_for_dispatch']));
    }

    function ptdIndex()
    {
        $orders = Order::with(['staff', 'designer'])->where(['dispatch_status' => 1])->paginate(25);

        return view('other.delivery.view_ptd', compact(['orders']));
    }


    function readyForDeliveryIndex()
    {
        $orders = Order::with(['staff', 'designer'])->where(['dispatch_status' => 2])->paginate(25);
        $riders = User::where(['role' => 'dispatch'])->limit(100)->get(['id', 'name']);
        return view('other.delivery.ready_for_dispatch', compact(['orders', 'riders']));
    }


    function enRoute()
    {
        $orders = Order::with(['customer:id,name', 'staff:id,name'])->where('dispatch_id', '>',  0)->get()->groupBy(function ($data) {
            return $data->dispatch_id;
        });
        return view('other.delivery.orders_onroad', compact(['orders']));
    }


    function readyForDelivery($id)
    {
        Order::where('id', $id)->update([
            'dispatch_status' => 2
        ]);

        $this->order_log($id, 'delivery', 'Order is ready for delivery ');

        return back()->with('success', 'Order marked as ready for delivery');
    }


    function assignRider(Request $request)
    {
        $orders = explode(',', $request->orders);
        $rider_id = $request->rider_id;
        foreach($orders as $order) {
            Order::where('id', $order)->update([
                'dispatch_id' => $rider_id,
                'dispatch_status' => 3
            ]);
            $this->order_log($order, 'delivery', 'Order has been assigned to a dispatcher');
        }
        return back()->with('success', 'Order has been assigned to dsipatcher, rider will be able to change delivery status now');
    }
}
