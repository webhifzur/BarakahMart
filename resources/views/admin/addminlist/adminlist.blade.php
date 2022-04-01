@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Admin List</h4>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Admin List</li>
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
                        <a href="#admin-register-modal" class="mr-1 ml-3 btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                        data-overlaySpeed="100" data-overlayColor="#36404a" style="float:left">
                            Add Admin
                        </a>
                        <a href="{{ route('admin.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin_infos as $admin_info)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $admin_info->name }}</td>
                                <td>{{ $admin_info->phone }}</td>
                                <td>{{ $admin_info->email }}</td>
                                <td>
                                    @if ($admin_info->type == 2)
                                        {{ 'Admin' }}
                                    @elseif($admin_info->type == 3)
                                        {{ 'Manager' }}
                                    @endif
                                </td>
                                <td>{{ $admin_info->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#view-modal{{ $admin_info->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                       data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.delete',$admin_info->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
                                </td>
                            </tr>
                             <!--View Modal -->
                            <div id="view-modal{{ $admin_info->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">Admin View</h4>
                                <div class="custom-modal-text">
                                   <div class="row">
                                        <div class="col col-sm-12 col-md-6">
                                            <div class="card-box">
                                                @if ($admin_info->profile_img == null)
                                                    <img src="{{ asset('admin/assets/images/avatar.jpg') }}" alt="Profile pic">
                                                @else
                                                    <img src="{{ asset('storage/public/'.$admin_info->profile_img) }}" alt="Profile pic">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Admin Name :</label>
                                                <label>{{ $admin_info->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin Phone :</label>
                                                <label>{{ $admin_info->phone }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin Email :</label>
                                                <label>{{ $admin_info->email }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin City :</label>
                                                <label>{{ city_name($admin_info->city)->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin Area :</label>
                                                <label>{{ area_name($admin_info->area)->name }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Admin Address :</label>
                                                <label>{{ $admin_info->address }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>

                    <!--admin-register-modal" -->
                    <div id="admin-register-modal" class="modal-demo">
                        <button type="button" class="close" onclick="Custombox.close();">
                            <span>&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="custom-modal-title">Add Admin</h4>
                        <div class="custom-modal-text">
                            <form id="add_form" class="form-horizontal" method="POST" action="{{ route('admin.register') }}">
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
                                <div class="form-group row m-b-20">
                                    <div class="col-12">
                                        <label for="emailaddress3">Admin Type</label>
                                        <select class="form-control" name="type">
                                            <option value="2">Admin</option>
                                            <option value="3">Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up Free</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script>
        //select2 js
        $(document).ready(function() {
            $('#area').select2();
            $('#add_form').parsley();
        });
    </script>
@endsection
