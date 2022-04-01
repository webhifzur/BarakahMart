@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">vendor</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">vendor</li>
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
                        <a href="#addvendor-modal" class="ml-3 mr-1 btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                            data-overlaySpeed="100" data-overlayColor="#36404a" style="float:left">
                            Add vendor
                        </a>
                        <a href="{{ route('vendor.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>address</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->phone }}</td>
                                <td>{{ $vendor->address }}</td>
                                <td>{{ $vendor->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#edit-modal{{ $vendor->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                       data-overlaySpeed="100" data-overlayColor="#36404a"><i class="far fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('vendor.destroy',$vendor->id) }}" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>
                             <!--Edit Modal -->
                            <div id="edit-modal{{ $vendor->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">Edit vendor</h4>
                                <div class="custom-modal-text">
                                    <form class="form-horizontal" method="POST" action="{{ route('vendor.update',$vendor->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $vendor->id }}">
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">vendor</label>
                                                <input type="text" class="form-control" name="name" value="{{  $vendor->name }}">
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">vendor Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{  $vendor->email }}">
                                            </div>
                                        </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">vendor Phone</label>
                                                    <input type="text" class="form-control" name="phone" value="{{  $vendor->phone }}">
                                            </div>
                                        </div>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">vendor address</label>
                                                <input type="text" class="form-control" name="address" value="{{  $vendor->address }}">
                                            </div>
                                        </div>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                    <!--addshop Modal -->
                   <div id="addvendor-modal" class="modal-demo">
                       <button type="button" class="close" onclick="Custombox.close();">
                           <span>&times;</span><span class="sr-only">Close</span>
                       </button>
                       <h4 class="custom-modal-title">Add vendor</h4>
                       <div class="custom-modal-text">
                           <form class="form-horizontal" method="POST" action="{{ route('vendor.store') }}">
                               @csrf
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">vendor Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="vendor Name">
                                   </div>
                               </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">vendor Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="vendor Email">
                                   </div>
                               </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">vendor Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="vendor Phone">
                                   </div>
                               </div>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">vendor address</label>
                                        <input type="text" class="form-control" name="address" placeholder="vendor address">
                                   </div>
                               </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               <div class="form-group account-btn text-center m-t-10">
                                   <div class="col-12">
                                       <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Add</button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('content.script')
    {{-- toastr js --}}
    <script>
        @if(Session::has('addsuccess'))
            // Display a success toast, with a title
            toastr.success('vendor Add Successfully', 'Congratulation!')
        @endif

        @if(Session::has('editsuccess'))
            // Display a success toast, with a title
            toastr.success('Shop Category Edit Successfully', 'Congratulation!')
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
