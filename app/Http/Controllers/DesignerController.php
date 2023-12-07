<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignerController extends Controller
{
    public function Index()
    {

   
        return view('other.designers.overview', compact([]));
    }


    public function undesigned()
    {
        $orders = Order::with(['customer:id,name', 'staff:id,name'])->where(['designer_id' => 0])->get()->groupBy(function ($data) {
            return $data->created_by;
        });
        return view('other.designers.undesigned', compact(['orders']));
    }




    function selected()
    {
        $orders = Order::with(['customer:id,name', 'staff:id,name'])->where(['designer_id' => auth()->user()->id])->orderby('updated_at', 'desc')->get();
        return view('other.designers.selected_designs', compact(['orders']));
    }   


    function completed()
    {
        // $completed =    OrderLog::with(['order'])->where([''])->create([
        //     'order_id' => $order->id,
        //     'logged_by' => auth()->user()->id,
        //     'department' => 'designer',
        //     'remark' => 'Order design has been completed',
        //     'status' => 'completed',
        //     'files' => json_encode($fileNames),
        // ]);
    }


    public function allMarketerDesign($id)
    {
        $marketer = User::findOrFail($id);
        $orders = Order::with(['customer:id,name', 'log.complete_design'])->where(['created_by' => $id])->orderBy('updated_at', 'desc')->get();
        return view('other.designers.m_orders', compact(['marketer', 'orders']));
    }


    function selectDesign(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        if ($order->designer_id) {
            return back()->with('error', 'This order has already been selected by another designer');
        }

        $order->update([
            'designer_id' => auth()->user()->id,
        ]);

        OrderLog::create([
            'order_id' => $order->id,
            'logged_by' => auth()->user()->id,
            'department' => 'designer',
            'remark' => 'A designer has commence activity on this order',
        ]);


        ///alert marketer that design has been created;

        return back()->with('success', 'Order Design has been assigned to you');
    }


    function completeDesign(Request $request)
    {
        $order = Order::findOrFail($request->id);
        if ($order->designer_id != auth()->user()->id) {
            return back()->with('error', 'You cannot complete this design becasue it was not assgied to you ');
        }


        $fileNames = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Generate a unique file name
                $fileName = uniqid($order->id . '_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('orders/designs'), $fileName);
                $fileNames[] = $fileName;
            }
        }


        OrderLog::create([
            'order_id' => $order->id,
            'logged_by' => auth()->user()->id,
            'department' => 'designer',
            'remark' => 'Order design has been completed',
            'status' => 'completed',
            'files' => json_encode($fileNames),
        ]);


        ///alert marketer
        return back()->with('success', 'Design has been marked completed');
    }
}
