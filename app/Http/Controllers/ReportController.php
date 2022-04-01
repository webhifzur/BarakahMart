<?php

namespace App\Http\Controllers;

use App\Models\Duepayment;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function vendordue(){
        return view('admin.report.vendordue',[
            'due_vendors' => PaymentDetails::where('due', '>', 0)->where('vendor_id', '!=', null)->get(),
        ]);
    }

    public function customerdue(){
        return view('admin.report.customerdue',[
            'due_customers' => PaymentDetails::where('due', '>', 0)->where('customer_id', '!=', 0)->where('customer_id', '!=', null)->get(),
        ]);
    }

    public function duepayment(Request $request)
    {
        $request->validate([
            'due_payment' => ['required'],
        ]);
        $payment_details = PaymentDetails::where('customer_id', $request->customer_id)->first();
        Duepayment::create([
            'payment_date' => date('Y-m-d'),
            'customer_id' => $request->customer_id,
            'pre_due' => $payment_details->due,
            'due_payment' => $request->due_payment,
            'total' => $payment_details->due - $request->due_payment,
            'created_by' => Auth::id(),
        ]);
        PaymentDetails::where('customer_id', $request->customer_id)->update([
            'cash' => $payment_details->cash + $request->due_payment,
            'due' => $payment_details->due - $request->due_payment,
        ]);
        return back()->with('success', 'successfull');
    }

    public function duepaymentvendor(Request $request)
    {
        $request->validate([
            'due_payment' => ['required'],
        ]);
        $payment_details = PaymentDetails::where('vendor_id', $request->vendor_id)->first();
        Duepayment::create([
            'payment_date' => date('Y-m-d'),
            'vendor_id' => $request->vendor_id,
            'pre_due' => $payment_details->due,
            'due_payment' => $request->due_payment,
            'total' => $payment_details->due - $request->due_payment,
            'created_by' => Auth::id(),
        ]);
        PaymentDetails::where('vendor_id', $request->vendor_id)->update([
            'cash' => $payment_details->cash + $request->due_payment,
            'due' => $payment_details->due - $request->due_payment,
        ]);
        return back()->with('success', 'successfull');
    }
}
