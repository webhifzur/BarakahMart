<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Duepayment;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use App\Models\CustomerMessage;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer', ['except' => ['productlist', 'productcategory']]);
    }

    

    public function customerlist()
    {
        return view('admin.customer.customerlist', [
            'customer_infos' => User::where('type', 0)->get(),
        ]);
    }

    public function customerdelete($id)
    {
        User::find($id)->delete();
        return back()->with('softdeletesuccess', 'softdelete successfully');
    }

    public function customerrestoreview()
    {
        return view('admin.customer.deletedcustomerlist', [
            'customer_infos' => User::onlyTrashed()->where('type', 0)->get(),
        ]);
    }

    public function customerrestore($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect(route('customer.list'))->with('restoresuccess', 'restore successfully');
    }

    public function forcedelete($id)
    {
        User::withTrashed()->find($id)->forcedelete();
        return redirect(route('customer.list'))->with('forcedeletesuccess', 'forcedelete successfully');
    }


}
