<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function orderplace(Request $request){
        // return cart_items();
        if ($request->s_check == 1) {
            $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required|max:15|min:11',
                'address' => 'required',
                'city_id' => 'required',
                'zipcode' => 'required',
                'pay_type' => 'required',
                's_fname' => 'required',
                's_lname' => 'required',
                's_email' => 'required',
                's_phone' => 'required|max:15|min:11',
                's_address' => 'required',
                's_zipcode' => 'required',
            ]);
        } else {
            $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required|max:15|min:11',
                'country' => 'required',
                'address' => 'required',
                'city_id' => 'required',
                'zipcode' => 'required',
                'pay_type' => 'required',
            ]);
        }

        $Billing_id = Billing::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'city_id' => $request->city_id,
        ]);

        if (!$request->s_check == 1) {
            $shipping_id = Shipping::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'city_id' => $request->city_id,
            ]);
        } else {
            $shipping_id = Shipping::create([
                'fname' => $request->s_fname,
                'lname' => $request->s_lname,
                'email' => $request->s_email,
                'phone' => $request->s_phone,
                'country' => $request->s_country,
                'address' => $request->s_address,
                'zipcode' => $request->s_zipcode,
                'city_id' => $request->s_city_id,
            ]);
        }

        $order_id = Order::create([
            // 'user_id' => Auth::id(),
            'user_id' => 1,
            'billing_id' => $Billing_id->id,
            'shipping_id' => $shipping_id->id,
            'subtotal' => $request->subtotal,
            'shipping' => $request->shipping,
            'total' => $request->total,
            'pay_type' => $request->pay_type,
            'payment_status' => 0,
            'tracking_code' => Str::random(6) . uniqid(),
            'note' => $request->note,
            'status' => 0,
        ]);
        foreach (cart_items() as $cart_data) {
            OrderDetails::create([
                'order_id' => $order_id->id,
                'product_id' => $cart_data->product_id,
                'product_name' => $cart_data->relationship_with_cart->name,
                'product_qty' => $cart_data->product_qty,
                'sell_price' => $cart_data->relationship_with_cart->sell_price,
                'total_price' => $cart_data->relationship_with_cart->sell_price * $cart_data->product_qty,
            ]);

            Product::find($cart_data->product_id)->decrement('qty', $cart_data->product_qty);
            $cart_data->forceDelete();
        }
        return redirect('/')->with('ordersuccess', 'Order succesfull');
    }
}
