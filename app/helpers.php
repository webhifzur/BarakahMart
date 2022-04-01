<?php

use App\Models\Area;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Duepayment;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cookie;

function cities()
{
    return City::all();
}
function city_name($id)
{
    return City::withTrashed()->where('id', $id)->first();
}

function areas()
{
    return Area::all();
}
function area_name($id)
{
    return Area::withTrashed()->where('id', $id)->first();
}

function customer($id){
    return User::withTrashed()->where('id', $id)->where('type',0)->first();
}

function vendor($id){
    return Vendor::withTrashed()->where('id', $id)->first();
}

function product($id){
    return Product::withTrashed()->where('id', $id)->first();
}

function duepatment($id){
    return Duepayment::withTrashed()->where('customer_id', $id)->get();
}

function duepatmentvendor($id){
    return Duepayment::withTrashed()->where('vendor_id', $id)->get();
}

function product_alert()
{
    $product_alert = Product::where('qty', '<' , 5)->count();
    if($product_alert != 0){
        return $product_alert;
    }
}

function product_alert_category($id)
{
    $product_alert_category = Product::where('shop_type',$id)->where('qty', '<' , 5)->count();
    if ($product_alert_category != 0) {
        return $product_alert_category;
    }
}

function cart_count()
{
    return Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->count();
}

function cart_items()
{
    return Cart::where('generated_cart_id', Cookie::get('g_cart_id'))->get();
}

function setting()
{
    return Setting::first();
}

function reviews($id)
{
    return OrderDetails::where('product_id', $id)->whereNotNull('review')->count();
}
function stars($id)
{
    return OrderDetails::where('product_id', $id)->whereNotNull('stars')->sum('stars');
}

function offer_count()
{
    return Offer::count();
}

function neworder()
{
    return Order::where('status',0)->latest()->get();
}

function neworder_count()
{
    return Order::where('status',0)->count();
}

function subcategory($id)
{
    return SubCategory::where('shop_type', $id)->get();
}

function subcategory_count($id)
{
    return SubCategory::where('shop_type', $id)->count();
}




 