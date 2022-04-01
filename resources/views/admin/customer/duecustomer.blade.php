@extends('layouts.app')

@section('content')
     <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Due Customer List</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Due Customer List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="text-center text-uppercase">Due Customer List</h4>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Total Purchase</th>
                            <th>Total Payment</th>
                            <th>Due</th>
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
                                                            <td>{{ $due_payment->payment_date->format('d/m/Y') }}</td>
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
                                                @error('due_payment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
@endsection

@section('content.script')
    {{-- toastr js --}}
    <script>
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

