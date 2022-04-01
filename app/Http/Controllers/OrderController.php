<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function neworderlist(){
        return view('customer.orderlist',[
            'orders' =>Order::where('status',0)->get(),
        ]);
    }
    
    public function receivedorder(){
        return view('customer.orderlist',[
            'orders' =>Order::where('status',1)->get(),
        ]);
    }

    public function canceledorder(){
        return view('customer.orderlist',[
            'orders' =>Order::where('status',3)->get(),
        ]);
    }

    public function deleveredorder(){
        return view('customer.orderlist',[
            'orders' =>Order::where('status',2)->get(),
        ]);
    }

    // Order Update Start
    public function received($id){
        Order::where('id',$id)->update([
            'status' => 1,
        ]);
        return back();
    }
    public function delevered($id){
        Order::where('id',$id)->update([
            'status' => 2,
        ]);
        return back();
    }
    public function canceled($id){
        Order::where('id',$id)->update([
            'status' => 3,
        ]);
        return back();
    }
    // Order Update End

    public function customerorderview($id){
        return view('customer.orderlist',[
            'orders' =>Order::where('user_id', $id)->get(),
        ]);
    }


    public function orderview($id){
        return view('customer.orderdetails',[
            'orders' => Order::where('id', $id)->first(),
            'orderdetails' => OrderDetails::where('order_id', $id)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'product_qty' => ['required'],
        ]);

        if ($request->product_id == '') {
            return back()->with('error', 'Please Add product');
        }else {
            $count_product = count($request->product_id);
            $order = Order::create([
                'order_date' => Carbon::now(),
                'customer_id' => Auth::id(),
                'customer_phone' => Auth::user()->phone,
                'subtotal' => $request->subtotal,
            ]);
            $order = $order->id;
            for ($i = 0; $i < $count_product; $i++) {
                OrderDetails::create([
                    'order_id' => $order,
                    'product_id' => $request->product_id[$i],
                    'unit_price' => $request->unit_price[$i],
                    'product_qty' => $request->product_qty[$i],
                    'product_total' => $request->product_total[$i],
                ]);
            };
        }
        return back()->with('success' , 'successfully orderd');
    }
}
