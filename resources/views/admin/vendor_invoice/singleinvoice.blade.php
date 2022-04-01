@extends('layouts.app')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="clearfix">
                    <div class="pull-left">
                        <img class="img-fluid" src="{{ asset('admin/assets/images/PNG.png') }}" alt="BarakahMart" width="220px" height="70px">
                    </div>
                    <div class="pull-right">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="pull-left mt-3">
                            <p><b>Hello, {{ vendor($invoice_info->vendor_id)->name }}</b></p>
                            <address class="line-h-24">
                                <strong>Barakah Mart</strong><br>
                                Star Palace Market <br>
                                Notun bazar-Baluchor,<br>
                                Sylhet Sadar.<br>
                                <span><strong>Phone :</strong> 01615754038 </span>
                            </address>
                        </div>
                    </div><!-- end col -->
                    <div class="col-4 offset-2">
                        <div class="mt-3 pull-right">
                            <p class="m-b-10"><strong>Order Date: </strong> {{ $invoice_info->created_at->format('d/m/Y') }} </p>
                            <p class="m-b-10"><strong>Order ID: </strong> {{ $invoice_info->id }} </p>
                            <p title="Phone"><strong>Phone:</strong> {{ $invoice_info->vendor_phone }} </p>
                            <h5>Billing Address:</h5>
                            <address class="line-h-24">
                                {{ vendor($invoice_info->vendor_id)->address }}
                            </address>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table mt-4">
                                <thead>
                                    <tr><th>SL.</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Product Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice_details as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ product($item->product_id)->name }}
                                            </td>
                                            <td>৳{{ $item->buy_price }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                            <td class="text-right">৳{{ $item->product_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Sub-total :</b></td>
                                        <td>৳{{ $invoice_info->subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>pre-ammount :</b></td>
                                        <td>৳{{ $invoice_info->pre_ammount }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total :</b></td>
                                        <td>৳{{ $invoice_info->total }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Cash :</b></td>
                                        <td>৳{{ $invoice_info->cash }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Return :</b></td>
                                        <td>৳{{ $invoice_info->return_taka }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Due :</b></td>
                                        <td>৳{{ $invoice_info->due }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="hidden-print mt-4 mb-4">
                    <div class="text-right">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection