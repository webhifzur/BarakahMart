<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    function addcart(Request $request)
    {
        // return $request->all();
        if (Cookie::get('g_cart_id')) {
            $generator_cart_id = Cookie::get('g_cart_id');
        } else {
            $generator_cart_id = Str::random(5) . rand(2, 1000);
            Cookie::queue('g_cart_id', $generator_cart_id, 1440);
        }

        if (Cart::where('generated_cart_id', $generator_cart_id)->where('product_id', $request->product_id)->exists()) {
            Cart::where('generated_cart_id', $generator_cart_id)->where('product_id', $request->product_id)->increment('product_qty', $request->product_qty);
        } else {
            Cart::create([
                'generated_cart_id' => $generator_cart_id,
                'product_id' => $request->product_id,
                'product_qty' => $request->product_qty,
            ]);
        }
        

        // if (Wishlist::where('product_id', $request->product_id)->exists()) {
        //     Wishlist::where('product_id', $request->product_id)->forceDelete();
        //     return back();
        // }

        return back();
    }

    function updatecart(Request $request)
    {
        foreach ($request->product_qty as $cart_id => $product_qty) {
            Cart::find($cart_id)->update([
                'product_qty' => $product_qty,
            ]);
        };
        return back();
    }

    function removecart($id)
    {
        Cart::find($id)->forceDelete();
        return back();
    }
}
