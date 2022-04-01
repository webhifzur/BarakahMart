<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use App\Models\PurchaseInvoice;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseInvoiceDetails;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.perchase', [
            'products' => Product::where('qty', '>', 0)->get(),
            'vendors' => Vendor::all(),
            'brands' => Brand::all(),
            'units' => Unit::all(),
            'shop_types' => ShopCategory::all(),
        ]);
    }

    public function vendorphone(Request $request)
    {
        $vendor = Vendor::where('id', $request->vendor)->first('phone');
        return $vendor;
    }
    public function vendorpreviousdue(Request $request)
    {
        $previousdue = PaymentDetails::where('vendor_id', $request->vendor)->first('due');
        return $previousdue;
    }
    public function purchaseinvoice(Request $request)
    {

        // return $request->all();

        $count_product = count($request->product_id);
        // return $count_product;
        $purchaseinvoice = PurchaseInvoice::create([
            'vendor_id' => $request->vendor_id,
            'vendor_phone' => $request->vendor_phone,
            'subTotal' => $request->subTotal,
            'pre_ammount' => $request->pre_ammount,
            'total' => $request->total,
            'cash' => $request->cash,
            'return_taka' => $request->return_taka,
            'due' => $request->due,
            'created_by' => Auth::id(),
        ]);
        $purchaseinvoice = $purchaseinvoice->id;
        for ($i = 0; $i < $count_product; $i++) {
            PurchaseInvoiceDetails::create([
                'p_invoice_id' => $purchaseinvoice,
                'product_id' => $request->product_id[$i],
                'buy_price' => $request->buy_price[$i],
                'product_qty' => $request->product_qty[$i],
                'product_total' => $request->product_total[$i],
            ]);
            $product = Product::where('id', $request->product_id[$i])->first();
            Product::where('id', $request->product_id[$i])->update([
                'brand' => $request->brand_id[$i],
                'buy_price' => $request->buy_price[$i],
                'sell_price' => $request->sell_price[$i],
                'qty' => $product->qty + $request->product_qty[$i],
                'unit' => $request->unit[$i],
            ]);
        };
        $payment_details = PaymentDetails::where('vendor_id', $request->vendor_id)->first();
        if($payment_details){
            PaymentDetails::where('vendor_id', $request->vendor_id)->update([
                'subTotal' => $payment_details->subTotal + $request->subTotal,
                'cash' => $payment_details->cash + ($request->cash - $request->return_taka),
                'due' => $request->due,
            ]);
        }
        else{
            PaymentDetails::create([
                'vendor_id' => $request->vendor_id,
                'subTotal' => $request->subTotal,
                'cash' => $request->cash - $request->return_taka,
                'due' => $request->due,
                'created_by' => Auth::id(),
            ]);
        }
        return redirect(route('vendorsingleinvoice', $purchaseinvoice));
    }

    public function invoiceview()
    {
        return view('admin.vendor_invoice.index', [
            'invoices' => PurchaseInvoice::all(),
        ]);
    }

    public function vendorsingleinvoice($id)
    {

        $purchaseinvoice = PurchaseInvoice::where('vendor_id', $id)->first();
        return view('admin.vendor_invoice.singleinvoice', [
            'invoice_info' => $purchaseinvoice,
            'invoice_details' => PurchaseInvoiceDetails::where('p_invoice_id',$purchaseinvoice->id)->get(),
        ]);
    }
}
