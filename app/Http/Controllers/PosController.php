<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetails;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('admin.pos',[
            'products' => Product::where('qty','>',0)->get(),
            'customers' => User::where('type', 0)->get(),
        ]);
    }

    public function customerphone(Request $request){
        $customer = User::where('id', $request->customer)->first('phone');
       return $customer;
    } 

    public function previousdue(Request $request){
        $previousdue = PaymentDetails::where('customer_id', $request->customer)->first('due');
       return $previousdue;
    } 

    public function unitprice(Request $request){
        $products = Product::where('id', $request->product_id)->first();
        return $products;
    }

    public function unitpricecoad(Request $request){
        $products = Product::where('id', $request->product_coad)->first();
        return $products;
    }
}