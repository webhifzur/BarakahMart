<?php

namespace App\Http\Controllers;

use App\Models\AdminSell;
use App\Models\CustomerMessage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Expence;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Duepayment;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer', ['except' => ['index', 'welcome']]);
    }

    public function welcome()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        $this->index();
        return redirect()->route('dashboard');
    }

    public function index()
    {
        if (Auth::user()->type == 0) {
            return view('dashboard',[
                'customer_invoices' => Invoice::where('customer_id',Auth::id())->get(),
            ]);
        }
        return view('dashboard',[
            // Total Info
            'total_sells' => Invoice::sum('subTotal'),
            'total_cashs_sells' => Invoice::sum('cash') - Invoice::sum('return_taka'),
            'total_due_payment' => Duepayment::sum('due_payment'),
            'total_expence' => Expence::sum('taka'),
            'total_dues' => PaymentDetails::sum('due'),
            'total_cash' => ((Invoice::sum('cash') - Invoice::sum('return_taka')) + Duepayment::sum('due_payment')) - Expence::sum('taka'),

            'total_customers' => User::where('type', 0)->count(),
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_invoice' => Invoice::count(),

            // Monthly Info
            'monthly_sells' => Invoice::whereMonth('created_at', Carbon::now()->month)->sum('subTotal'),
            'monthly_cashs_sells' => Invoice::whereMonth('created_at', Carbon::now()->month)->sum('cash')  - Invoice::whereMonth('created_at', Carbon::now()->month)->sum('return_taka'),
            'monthly_due_payment' => Duepayment::whereMonth('created_at', Carbon::now()->month)->sum('due_payment'),
            'monthly_expence' => Expence::whereMonth('created_at', Carbon::now()->month)->sum('taka'),
            'monthly_dues' => Invoice::whereMonth('created_at', Carbon::now()->month)->sum('due'),
            'monthly_cash' => ((Invoice::whereMonth('created_at', Carbon::now()->month)->sum('cash')  - Invoice::whereMonth('created_at', Carbon::now()->month)->sum('return_taka')) + Duepayment::whereMonth('created_at', Carbon::now()->month)->sum('due_payment')) - Expence::whereMonth('created_at', Carbon::now()->month)->sum('taka'),

            // Today Info
            'today_sells' => Invoice::whereDay('created_at', Carbon::now()->day)->sum('subTotal'),
            'today_cash_sells' => Invoice::whereDay('created_at', Carbon::now()->day)->sum('cash')  - Invoice::whereDay('created_at', Carbon::now()->day)->sum('return_taka'),
            'today_due_payment' => Duepayment::whereDay('created_at', Carbon::now()->day)->sum('due_payment'),
            'today_expence' => Expence::whereDay('created_at', Carbon::now()->day)->sum('taka'),
            'today_dues' => Invoice::whereDay('created_at', Carbon::now()->day)->sum('due'),
            'today_cash' => ((Invoice::whereDay('created_at', Carbon::now()->day)->sum('cash')  - Invoice::whereDay('created_at', Carbon::now()->day)->sum('return_taka')) + Duepayment::whereDay('created_at', Carbon::now()->day)->sum('due_payment')) - Expence::whereDay('created_at', Carbon::now()->day)->sum('taka'),

            'due_customers' => PaymentDetails::where('due', '>', 0)->where('customer_id', '!=', 0)->get(),
            'highest_customers' => PaymentDetails::where('customer_id', '!=', 0)->orderBy('subTotal', 'desc')->limit(10)->get(),
            'newOrders' => Order::where('status', 0)->get(),

            // Monthly admin sells
            'admin_sells' =>AdminSell::whereMonth('created_at', Carbon::now()->month)->get(),
        ]);
    }


    public function filterdate(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $dashboard_data = [
            // Total Info
            'total_sells' => Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('subTotal'),
            'total_cashs_sells' => Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('cash') - Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('return_taka'),
            'total_due_payment' => Duepayment::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('due_payment'),
            'total_expence' => Expence::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('taka'),
            'total_dues' => Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('due'),
            'total_cash' => ((Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('cash') - Invoice::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('return_taka')) + Duepayment::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('due_payment')) - Expence::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->sum('taka'),
        ];
        return $dashboard_data;
    }

}
