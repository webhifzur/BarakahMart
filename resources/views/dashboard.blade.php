@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Dashboard</h4>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
    @if (Auth::user()->type == 1)
        <div class="row">
            <div class="col-sm-6 col-lg-6 col-md-6 col-6">
                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" name="start_date" placeholder="Starting Date" id="start_date" value=""/>
                    <span class="input-group-addon bg-primary text-white p-2">TO</span>
                    <input type="text" class="form-control" name="end_date" placeholder="Ending Date" id="end_date" value=""/>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-md-6 col-6">
                <button type="submit" id="form_btn" class="bg-primary text-white p-2" style="border:none; cursor:pointer; ">Submit</button>
            </div>
        </div>
        <div>
            <h3 class="text-center">Total Sells Information</h3>
            <div class="row text-center mt-3">
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box widget-flat border-custom bg-custom">
                        <i class="fab fa-sellsy"></i>
                        <h3 class="m-b-10" id="total_sells"><span>৳</span>{{ $total_sells }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Sells</p>
                    </div>
                </div>
                 <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box widget-flat border-success bg-success">
                        <i class="fi-help"></i>
                        <h3 class="m-b-10" id="total_cashs_sells"><span>৳</span>{{ $total_cashs_sells }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Cash Sells</p>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box bg-info widget-flat border-info">
                        <i class="fi-tag"></i>
                        <h3 class="m-b-10" id="total_due_payment"><span>৳</span>{{ $total_due_payment }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Due Payment</p>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box bg-primary widget-flat border-primary">
                        <i class="fi-archive"></i>
                        <h3 class="m-b-10" id="total_expence"><span>৳</span>{{ $total_expence }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Cost</p>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box bg-danger widget-flat border-danger">
                        <i class="fi-delete"></i>
                        <h3 class="m-b-10" id="total_dues"><span>৳</span>{{ $total_dues }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Due</p>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box bg-secondary widget-flat border-secondary">
                        <i class="fas fa-dollar-sign"></i>
                        <h3 class="m-b-10" id="total_cash"><span>৳</span>{{ $total_cash }}</h3>
                        <p class="text-uppercase m-b-5 font-16 font-600">Total Cash</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <h3 class="text-center">Monthly Sells Information</h3>
        <div class="row text-center mt-3">
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box widget-flat border-custom bg-custom ">
                    <i class="fab fa-sellsy"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_sells }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Sells</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box widget-flat border-success bg-success">
                    <i class="fi-help"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_cashs_sells }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Cash Sells</h4>
                </div>
            </div>
             <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-info widget-flat border-info">
                    <i class="fi-tag"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_due_payment }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Due Payment</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-primary widget-flat border-primary">
                    <i class="fi-archive"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_expence }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Cost</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-danger widget-flat border-danger">
                    <i class="fi-delete"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_dues }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Dues</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-secondary widget-flat border-secondary">
                    <i class="fas fa-dollar-sign"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $monthly_cash }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Monthly Cash</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <h3 class="text-center">Monthly Admin Sell Invoice</h3>
        <div class="row text-center mt-3">
            @foreach ($admin_sells as $admin_sell)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="card-box widget-flat border-custom bg-warning">
                        <i class="fab fa-sellsy"></i>
                        <h3 class="m-b-10"><span>৳</span>{{ $admin_sell->subTotal }}</h3>
                        <h4 class="text-uppercase m-b-5 ">{{ $admin_sell->adminName->name }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- end row -->
    @endif
    @if (Auth::user()->type == 1 || Auth::user()->type == 2)
        <h3 class="text-center">Today Sells Information</h3>
        <div class="row text-center mt-3">
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box widget-flat border-custom bg-custom">
                    <i class="fab fa-sellsy"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_sells }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Sells</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box widget-flat border-success bg-success">
                    <i class="fi-help"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_cash_sells }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Cash Sells</h4>
                </div>
            </div>
             <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-info widget-flat border-info">
                    <i class="fi-tag"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_due_payment }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Due Payment</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-primary widget-flat border-primary">
                    <i class="fi-archive"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_expence }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Cost</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-danger widget-flat border-danger">
                    <i class="fi-delete"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_dues }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Dues</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="card-box bg-secondary widget-flat border-secondary">
                    <i class="fas fa-dollar-sign"></i>
                    <h3 class="m-b-10"><span>৳</span>{{ $today_cash }}</h3>
                    <h4 class="text-uppercase m-b-5 ">Today Cash</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fas fa-user-tag float-right text-muted mt-4"></i>
                    <h5 class="text-muted text-uppercase mt-0">Total Customer</h5>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $total_customers }}</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fab fa-product-hunt float-right text-muted mt-4"></i>
                    <h5 class="text-muted text-uppercase mt-0">Total Product</h5>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $total_products }}</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="icon-layers float-right text-muted mt-4"></i>
                    <h5 class="text-muted text-uppercase mt-0">Total Order Online</h5>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $total_orders }}</h2>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fas fa-file-invoice float-right text-muted mt-4"></i>
                    <h5 class="text-muted text-uppercase mt-0">Total Invoice</h5>
                    <h2 class="m-b-20" data-plugin="counterup">{{ $total_invoice }}</h2>
                </div>
            </div>
        </div>
        <!-- end row -->
        {{-- <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">New Order List</h4>
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newOrders as $newOrder)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $newOrder->customer->name }}</td>
                                    <td>{{ $newOrder->customer->phone }}</td>
                                    <td>{{ $newOrder->subtotal }}</td>
                                    <td>{{ $newOrder->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('orderdetails',$newOrder->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">Due Customer List</h4>
                    <table id="datatable_buttons_due" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Purchase</th>
                                <th>Total Payment</th>
                                <th>Due</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($due_customers as $due_customer)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    @if (!$due_customer->customer_id == 0)
                                        <td>{{ $due_customer->customer->name }}</td>
                                        <td>{{ $due_customer->customer->phone }}</td>
                                    @else
                                        <td>{{ 'Walk Customer' }}</td>
                                        <td></td>
                                    @endif
                                    <td>{{ $due_customer->subTotal }}</td>
                                    <td>{{ $due_customer->cash }}</td>
                                    <td>{{ $due_customer->due }}</td>
                                    <td>{{ $due_customer->admin->name }}</td>
                                    <td>
                                        <a href="{{ route('customer.invoice',$due_customer->customer_id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#Payment-modal{{ $due_customer->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                            data-overlaySpeed="100" data-overlayColor="#36404a">Payment
                                        </a>
                                        <a href="#view-payment-modal{{ $due_customer->customer_id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                            data-overlaySpeed="100" data-overlayColor="#36404a">View Payment
                                        </a>
                                        <!--View Payment Model -->
                                        <div id="view-payment-modal{{ $due_customer->customer_id }}" class="modal-demo">
                                            <button type="button" class="close" onclick="Custombox.close();">
                                                <span>&times;</span><span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="custom-modal-title">View Payment</h4>
                                            <div class="custom-modal-text">
                                                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>Sl No.</th>
                                                            <th>Payment Date</th>
                                                            <th>Name</th>
                                                            <th>Previous Due Ammount</th>
                                                            <th>Payment</th>
                                                            <th>Due</th>
                                                            <th>Payment Receive</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (duepatment($due_customer->customer_id) as $due_payment)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $due_payment->payment_date }}</td>
                                                                <td>{{ $due_payment->customer->name }}</td>
                                                                <td>{{ $due_payment->pre_due }}</td>
                                                                <td>{{ $due_payment->due_payment }}</td>
                                                                <td>{{ $due_payment->total }}</td>
                                                                <td>{{ $due_payment->admin->name}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!--Payment Modal -->
                                <div id="Payment-modal{{ $due_customer->id }}" class="modal-demo">
                                    <button type="button" class="close" onclick="Custombox.close();">
                                        <span>&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="custom-modal-title">Due Payment</h4>
                                    <div class="custom-modal-text">
                                        <form method="POST" action="{{ route('due.payment') }}">
                                        @csrf
                                            <div class="row">
                                                <input type="hidden" name="customer_id" value="{{ $due_customer->customer_id }}">
                                                <div class="form-group col-12">
                                                    <label>Due Ammount :</label>
                                                    <label>{{ $due_customer->due }}</label>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Payment :</label>
                                                    <input class="form-control" type="number" name="due_payment">
                                                </div>
                                                    <div class="form-group">
                                                        <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">Highest Seller List</h4>
                    <table id="datatable_buttons_highest" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Purchase</th>
                                <th>Total Payment</th>
                                <th>Due</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($highest_customers as $highest_customer)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    @if (!$highest_customer->customer_id == 0)
                                        <td>{{ $highest_customer->customer->name }}</td>
                                        <td>{{ $highest_customer->customer->phone }}</td>
                                    @else
                                        <td>{{ 'Walk Customer' }}</td>
                                        <td></td>
                                    @endif
                                    <td>{{ $highest_customer->subTotal }}</td>
                                    <td>{{ $highest_customer->cash }}</td>
                                    <td>{{ $highest_customer->due }}</td>
                                    <td>{{ $highest_customer->admin->name }}</td>
                                    <td>
                                        <a href="{{ route('customer.invoice',$highest_customer->customer_id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endif
    @if (Auth::user()->type == 3)
        {{-- <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">New Order List</h4>
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newOrders as $newOrder)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $newOrder->customer->name }}</td>
                                    <td>{{ $newOrder->customer_phone }}</td>
                                    <td>{{ $newOrder->subtotal }}</td>
                                    <td>{{ $newOrder->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('orderdetails',$newOrder->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">Due Customer List</h4>
                    <table id="datatable_buttons_due" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Purchase</th>
                                <th>Total Payment</th>
                                <th>Due</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($due_customers as $due_customer)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    @if (!$due_customer->customer_id == 0)
                                        <td>{{ $due_customer->customer->name }}</td>
                                        <td>{{ $due_customer->customer->phone }}</td>
                                    @else
                                        <td>{{ 'Walk Customer' }}</td>
                                        <td></td>
                                    @endif
                                    <td>{{ $due_customer->subTotal }}</td>
                                    <td>{{ $due_customer->cash }}</td>
                                    <td>{{ $due_customer->due }}</td>
                                    <td>{{ $due_customer->admin->name }}</td>
                                    <td>
                                        <a href="{{ route('customer.invoice',$due_customer->customer_id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#Payment-modal{{ $due_customer->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                            data-overlaySpeed="100" data-overlayColor="#36404a">Payment
                                        </a>
                                        <a href="#view-payment-modal{{ $due_customer->customer_id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                            data-overlaySpeed="100" data-overlayColor="#36404a">View Payment
                                        </a>
                                        <!--View Payment Model -->
                                        <div id="view-payment-modal{{ $due_customer->customer_id }}" class="modal-demo">
                                            <button type="button" class="close" onclick="Custombox.close();">
                                                <span>&times;</span><span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="custom-modal-title">View Payment</h4>
                                            <div class="custom-modal-text">
                                                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>Sl No.</th>
                                                            <th>Payment Date</th>
                                                            <th>Name</th>
                                                            <th>Previous Due Ammount</th>
                                                            <th>Payment</th>
                                                            <th>Due</th>
                                                            <th>Payment Receive</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (duepatment($due_customer->customer_id) as $due_payment)
                                                            <tr>
                                                                <td>{{ $loop->index + 1 }}</td>
                                                                <td>{{ $due_payment->payment_date }}</td>
                                                                <td>{{ $due_payment->customer->name }}</td>
                                                                <td>{{ $due_payment->pre_due }}</td>
                                                                <td>{{ $due_payment->due_payment }}</td>
                                                                <td>{{ $due_payment->total }}</td>
                                                                <td>{{ $due_payment->admin->name}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!--Payment Modal -->
                                <div id="Payment-modal{{ $due_customer->id }}" class="modal-demo">
                                    <button type="button" class="close" onclick="Custombox.close();">
                                        <span>&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="custom-modal-title">Due Payment</h4>
                                    <div class="custom-modal-text">
                                        <form method="POST" action="{{ route('due.payment') }}">
                                        @csrf
                                            <div class="row">
                                                <input type="hidden" name="customer_id" value="{{ $due_customer->customer_id }}">
                                                <div class="form-group col-12">
                                                    <label>Due Ammount :</label>
                                                    <label>{{ $due_customer->due }}</label>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Payment :</label>
                                                    <input class="form-control" type="number" name="due_payment">
                                                </div>
                                                    <div class="form-group">
                                                        <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <h4 class="text-center text-uppercase">Highest Seller List</h4>
                    <table id="datatable_buttons_highest" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total Purchase</th>
                                <th>Total Payment</th>
                                <th>Due</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($highest_customers as $highest_customer)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    @if (!$highest_customer->customer_id == 0)
                                        <td>{{ $highest_customer->customer->name }}</td>
                                        <td>{{ $highest_customer->customer->phone }}</td>
                                    @else
                                        <td>{{ 'Walk Customer' }}</td>
                                        <td></td>
                                    @endif
                                    <td>{{ $highest_customer->subTotal }}</td>
                                    <td>{{ $highest_customer->cash }}</td>
                                    <td>{{ $highest_customer->due }}</td>
                                    <td>{{ $highest_customer->admin->name }}</td>
                                    <td>
                                        <a href="{{ route('customer.invoice',$highest_customer->customer_id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endif

@endsection

@section('content.script')
    <script type="text/javascript">
        $(document).ready(function() {
            
        // Default Datatable
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable_buttons_due').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });

        // Responsive Datatable
        $('#responsive-datatable').DataTable();

        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });

        table.buttons().container()
                .appendTo('#datatable_buttons_due_wrapper .col-md-6:eq(0)');
        } );
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            
            // Default Datatable
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable_buttons_highest').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf']
            });

            // Key Tables

            $('#key-table').DataTable({
                keys: true
            });

            // Responsive Datatable
            $('#responsive-datatable').DataTable();

            // Multi Selection Datatable
            $('#selection-datatable').DataTable({
                select: {
                    style: 'multi'
                }
            });

            table.buttons().container()
                    .appendTo('#datatable_buttons_highest_wrapper .col-md-6:eq(0)');
        } );
    </script>

    <script>
        // Date Picker
        jQuery('#datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#datepicker-inline').datepicker();
        jQuery('#datepicker-multiple-date').datepicker({
            format: "yyyy-mm-dd",
            clearBtn: true,
            multidate: true,
            multidateSeparator: ","
        });
        jQuery('#date-range').datepicker({
            format: "yyyy-mm-dd",
            toggleActive: true
        });

        //Ajax script
        $(document).ready(function(){
                $('#form_btn').on('click',function(){
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                //ajax setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type :'POST',
                    url : '/get/filter/date',
                    data : {start_date:start_date , end_date:end_date},
                    success : function (data) {
                        document.getElementById('total_sells').innerHTML = data['total_sells'];
                        document.getElementById('total_cashs_sells').innerHTML = data['total_cashs_sells'];
                        document.getElementById('total_due_payment').innerHTML = data['total_due_payment'];
                        document.getElementById('total_expence').innerHTML = data['total_expence'];
                        document.getElementById('total_dues').innerHTML = data['total_dues'];
                        document.getElementById('total_cash').innerHTML = data['total_cash'];
                    }
                });
            });
        });
        @if(Session::has('success'))
            // Display a success toast, with a title
            toastr.success('Payment Successfull', 'Congratulation!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection
