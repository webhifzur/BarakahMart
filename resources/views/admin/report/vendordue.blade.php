@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="text-center text-uppercase">Due Vendor List</h4>
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
                    @forelse ($due_vendors as $due_vendor)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $due_vendor->vendor->name }}</td>
                            <td>{{ $due_vendor->vendor->phone }}</td>
                            <td>{{ $due_vendor->subTotal }}</td>
                            <td>{{ $due_vendor->cash }}</td>
                            <td>{{ $due_vendor->due }}</td>
                            <td>{{ $due_vendor->admin->name }}</td>
                            <td>
                                <a href="{{ route('vendorsingleinvoice',$due_vendor->vendor_id) }}" class="btn btn-icon waves-effect waves-light btn-primary"><i class="fas fa-eye"></i>
                                </a>
                                <a href="#Payment-modal{{ $due_vendor->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                    data-overlaySpeed="100" data-overlayColor="#36404a">Payment
                                </a>
                                <a href="#view-payment-modal{{ $due_vendor->vendor_id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                    data-overlaySpeed="100" data-overlayColor="#36404a">View Payment
                                </a>
                                <!--View Payment Model -->
                                <div id="view-payment-modal{{ $due_vendor->vendor_id }}" class="modal-demo">
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
                                                    <th>Pre Due</th>
                                                    <th>Payment</th>
                                                    <th>Due</th>
                                                    <th>Receive</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (duepatmentvendor($due_vendor->vendor_id) as $due_payment)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $due_payment->payment_date }}</td>
                                                        <td>{{ $due_payment->vendor->name }}</td>
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
                        <div id="Payment-modal{{ $due_vendor->id }}" class="modal-demo">
                            <button type="button" class="close" onclick="Custombox.close();">
                                <span>&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h4 class="custom-modal-title">Due Payment</h4>
                            <div class="custom-modal-text">
                                <form method="POST" action="{{ route('due.payment.vendor') }}">
                                @csrf
                                    <div class="row">
                                        <input type="hidden" name="vendor_id" value="{{ $due_vendor->vendor_id }}">
                                        <div class="form-group col-12">
                                            <label>Due Ammount :</label>
                                            <label>{{ $due_vendor->due }}</label>
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
                    @empty 
                        <td class="text-danger text-center" colspan="50">
                            <span>No Data Available</span>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->
@endsection