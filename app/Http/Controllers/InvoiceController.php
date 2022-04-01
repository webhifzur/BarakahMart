<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\AdminSell;
use App\Models\Duepayment;
use Illuminate\Http\Request;
use App\Models\InvoiceDetails;
use App\Models\PaymentDetails;
use App\Models\PurchaseInvoice;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseInvoiceDetails;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer', ['except' => ['singleinvoice', 'customerinvoice']]);
    }
    
    public function index()
    {
        return view('admin.invoice.index',[
            'invoices' => Invoice::all(),
        ]);
    }

    public function customerinvoice($id)
    {
        return view('admin.invoice.index',[
            'invoices' => Invoice::where('customer_id' , $id)->get(),
        ]);
    }

    public function vendorinvoice($id)
    {
        return view('admin.invoice.index',[
            'invoices' => PurchaseInvoice::where('vendor_id' , $id)->get(),
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'product_id' => ['required'],
            'product_qty' => ['required'],
        ]);
        
        if($request->product_id == '' ){
            return back()->with('error', 'Please Add product');
        }
        else{
            $count_product = count($request->product_id);
            $invoice = Invoice::create([
                'invoice_date' => $request->invioce_date,
                'customer_type' => $request->customer_type,
                'customer_id' => $request->customer_id,
                'customer_phone' => $request->customer_phone,
                'subTotal' => $request->subTotal,
                'pre_ammount' => $request->pre_ammount,
                'total' => $request->total,
                'cash' => $request->cash,
                'return_taka' => $request->return_taka,
                'due' => $request->due,
                'created_by' => Auth::id(),
            ]);
            $invoice = $invoice->id;
            for ($i = 0; $i < $count_product; $i++) {
                InvoiceDetails::create([
                    'invoice_id' => $invoice,
                    'product_id' => $request->product_id[$i],
                    'unit_price' => $request->unit_price[$i],
                    'product_qty' => $request->product_qty[$i],
                    'product_total' => $request->product_total[$i],
                ]);
                $product = Product::where('id', $request->product_id[$i])->first();
                Product::where('id', $request->product_id[$i])->update([
                    'qty' => $product->qty - $request->product_qty[$i],
                ]);
            };
            $payment_details = PaymentDetails::where('customer_id', $request->customer_id)->first();
            if($payment_details){
                PaymentDetails::where('customer_id', $request->customer_id)->update([
                    'subTotal' => $payment_details->subTotal + $request->subTotal,
                    'cash' => $payment_details->cash + ($request->cash - $request->return_taka),
                    'due' => $request->due,
                ]);
            }elseif($request->customer_id == null){
                PaymentDetails::create([
                    'customer_id' => 0,
                    'subTotal' => $request->subTotal,
                    'cash' => $request->cash - $request->return_taka,
                    'due' => $request->due,
                    'created_by' => Auth::id(),
                ]);
            }
            else{
                PaymentDetails::create([
                    'customer_id' => $request->customer_id,
                    'subTotal' => $request->subTotal,
                    'cash' => $request->cash - $request->return_taka,
                    'due' => $request->due,
                    'created_by' => Auth::id(),
                ]);
            }
            $admin_sells = AdminSell::where('admin', Auth::id())->whereMonth('created_at', Carbon::now()->month)->first();
            if ($admin_sells) {
                AdminSell::where('admin', Auth::id())->whereMonth('created_at', Carbon::now()->month)->update([
                    'subTotal' => $admin_sells->subTotal + $request->subTotal,
                    'cash' => $admin_sells->cash + ($request->cash - $request->return_taka),
                    'due' => $request->due,
                ]);
            } 
            else {
                AdminSell::create([
                    'admin' => Auth::id(),
                    'subTotal' => $request->subTotal,
                    'cash' => $request->cash - $request->return_taka,
                    'due' => $request->due,
                ]);
            }
        }
        return redirect(route('singleinvoice', $invoice));
    }

    public function singleinvoice($id)
    {
        return view('singleinvoice',[
            'invoice_info' => Invoice::where('id',$id)->first(),
            'invoice_details' => InvoiceDetails::where('invoice_id',$id)->get(),
        ]);
    }

    public function vendorsingleinvoice($id)
    {
        return view('vendorsingleinvoice',[
            'invoice_info' => PurchaseInvoice::where('id',$id)->first(),
            'invoice_details' => PurchaseInvoiceDetails::where('invoice_id',$id)->get(),
        ]);
    }

}
