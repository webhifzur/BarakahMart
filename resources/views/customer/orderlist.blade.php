@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Order List</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Order List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="{{ (Auth::user()->type == 0 ? 'datatable-button' : 'datatable-buttons') }}" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Order Date</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Sub Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->customer->phone }}</td>
                                <td>{{ $order->subtotal }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        {{ 'Pending' }}
                                    @elseif($order->status == 1)
                                        {{ 'Received' }}
                                    @elseif($order->status == 2)
                                        {{ 'Delivered' }}
                                    @elseif($order->status == 3)
                                        {{ 'Cancel' }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('orderdetails',$order->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty 
                            <tr>
                                <td class="text-center" colspan="50">No Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

