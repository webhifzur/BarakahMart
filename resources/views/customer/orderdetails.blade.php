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
                        <h4 class="m-0 d-print-none">Order Details</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="pull-left mt-3">
                            <p><b>Hello, {{ $orders->customer->name }}</b></p>
                            <address class="line-h-24">
                                <strong>Barakah Mart</strong><br>
                                Star Palace Market <br>
                                Notun bazar-Baluchor,<br>
                                Sylhet Sadar.<br>
                                <span><strong>Phone :</strong> 01615754038 </span>
                            </address>
                        </div>
                    </div><!-- end col -->
                    <div class="col-4">
                        <div class="mt-3">
                            <p title="Phone"><strong>Name:</strong> {{ $orders->shipping_details->fname . ' ' .$orders->shipping_details->lname }} </p>
                            <p title="Phone"><strong>Phone:</strong> {{ $orders->shipping_details->phone }} </p>
                            <h5>Shipping Address:</h5>
                            <address class="line-h-24">
                                {{ $orders->shipping_details->address }}
                            </address>
                        </div>
                    </div><!-- end col -->
                    <div class="col-4">
                        <div class="mt-3 pull-right">
                            <p class="m-b-10"><strong>Order Date: </strong> {{ $orders->created_at->format('d/m/Y') }} </p>
                            <p class="m-b-10"><small><strong>Order Status: </strong></small> <span class="label label-success">
                                @if ($orders->status == 0)
                                {{ 'Pendding' }}
                                @elseif($orders->status == 1)
                                    {{ 'Received' }}
                                @elseif($orders->status == 2)
                                    {{ 'Delivered' }}
                                @elseif($orders->status == 3)
                                    {{ 'Canceled' }}
                                @endif
                            </span></p>
                            <p title="Phone"><strong>Name:</strong> {{ $orders->customer->name }} </p>
                            <p title="Phone"><strong>Phone:</strong> {{ $orders->customer->phone }} </p>
                            <h5>Billing Address:</h5>
                            <address class="line-h-24">
                                {{ $orders->billing_details->address }}
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
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Product Quantity</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderdetails as $item)
                                    <tr>
                                        <td>
                                            {{ product($item->product_id)->name }}
                                        </td>
                                        <td>৳{{ $item->sell_price }}</td>
                                        <td>{{ $item->product_qty }}</td>
                                        <td class="text-right">৳{{ $item->total_price }}</td>
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
                        <div class="float-right">
                            <p><b>Sub Total :</b>৳{{ $orders->subtotal }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="hidden-print mt-4 mb-4">
                    <div class="text-right">
                        @if ($orders->status == 0)
                            <a href="{{ route('canceled',$orders->id) }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                            <a href="{{ route('received',$orders->id) }}" class="btn btn-success waves-effect waves-light">Received</a>
                        @elseif($orders->status == 1)
                            <a href="{{ route('canceled',$orders->id) }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                            <a href="{{ route('delevered',$orders->id) }}" class="btn btn-success waves-effect waves-light">Delivered</a>
                        @endif
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection