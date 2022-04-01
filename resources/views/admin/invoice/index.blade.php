@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Invoice</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
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
                            <th>Invoice Date</th>
                            <th>Customer Name</th>
                            <th>Subtotal</th>
                            <th>Cash</th>
                            <th>Due</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $invoice->created_at->format('d/m/Y H:i:s') }}</td>
                                @if (!$invoice->customer_id == 0)
                                    <td>{{ $invoice->customer->name }}</td>
                                @else
                                    <td>{{ 'Walk Customer' }}</td>
                                @endif
                                <td>{{ $invoice->subTotal }}</td>
                                <td>{{ $invoice->cash }}</td>
                                <td>{{ $invoice->due }}</td>
                                <td>{{ $invoice->admin->name }}</td>
                                <td>
                                    <a href="{{ route('singleinvoice',$invoice->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="far fa-eye"></i>
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

@section('content.script')
    
@endsection
