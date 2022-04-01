@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Customer List</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer List</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <button type="button" class="mr-1 ml-3 btn btn-primary waves-effect waves-light" style="float:left" data-toggle="modal" data-target="#signup-modal">Add Customer</button>
                        <a href="{{ route('customer.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Created At</th>
                            @if (Auth::user()->type == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer_infos as $customer_info)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $customer_info->name }}</td>
                                <td>{{ $customer_info->phone }}</td>
                                <td>{{ $customer_info->email }}</td>
                                <td>{{ $customer_info->created_at->format('d/m/Y') }}</td>
                                @if (Auth::user()->type == 1)
                                    <td>
                                        <a href="#view-modal{{ $customer_info->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('customer.delete',$customer_info->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
                                    </td>
                                @endif
                            </tr>
                            <!--Edit Modal -->
                            <div id="view-modal{{ $customer_info->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">View Customer</h4>
                                <div class="custom-modal-text">
                                     <div class="row">
                                        <div class="col col-sm-12 col-md-6">
                                            <div class="card-box">
                                                @if ($customer_info->profile_img == null)
                                                    <img src="{{ asset('admin/assets/images/avatar.jpg') }}" alt="Profile pic">
                                                @else
                                                    <img src="{{ asset('storage/public/'.$customer_info->profile_img) }}" alt="Profile pic">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name :</label>
                                                <label>{{ $customer_info->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Customer Phone :</label>
                                                <label>{{ $customer_info->phone }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Customer Email :</label>
                                                <label>{{ $customer_info->email }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Customer City :</label>
                                                <label>{{ city_name($customer_info->city)->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Customer Area :</label>
                                                <label>{{ area_name($customer_info->area)->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin Address :</label>
                                                <label>{{ $customer_info->address }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>

                   <!-- Customer Signup modal content -->
                    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h2 class="text-uppercase text-center m-b-30">
                                        Add Customer
                                    </h2>
                                    <form class="form-horizontal" method="POST" action="{{ route('customer.register') }}">
                                        @csrf
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Phone</label>
                                                <input class="form-control" type="text" placeholder="Enter Your Phone" name="phone" value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Email address</label>
                                                <input class="form-control" type="email" placeholder="Enter Email address" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                         <div class="form-group row m-b-20">
                                            <div class="col-6">
                                                <label>City</label>
                                                <select name="city" id="" class="form-control">
                                                    @foreach (cities() as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label>Area</label>
                                                <select name="area" id="area" class="form-control">
                                                    @foreach (areas() as $area)
                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('area')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Address</label>
                                                <textarea class="form-control" name="address" placeholder="type your full address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Password</label>
                                                <input id="pass1" class="form-control" type="password" name="password" placeholder="Enter your password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label>Confirm Password</label>
                                                <input data-parsley-equalto="#pass1" class="form-control" type="password" name="password_confirmation" placeholder="Enter your Confirm password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('content.script')
    {{-- toastr js --}}
    <script>
        @if(Session::has('registersuccess'))
            // Display a success toast, with a title
            toastr.success('Your Registration Successfully', 'Congratulation!')
        @endif

        @if(Session::has('editsuccess'))
            // Display a success toast, with a title
            toastr.success('Your Edit Successfully', 'Congratulation!')
        @endif

        @if(Session::has('softdeletesuccess'))
            // Display a success toast, with a title
            toastr.success('Your Soft Delete Successfully', 'Congratulation!')
        @endif

        @if(Session::has('restoresuccess'))
            // Display a success toast, with a title
            toastr.success('Your Soft Restore Successfully', 'Congratulation!')
        @endif

        @if(Session::has('forcedeletesuccess'))
            // Display a success toast, with a title
            toastr.success('Your Force Delete Successfully', 'Congratulation!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection
