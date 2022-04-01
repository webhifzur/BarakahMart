@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Deleted Customer List</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('customer.list') }}">Customer List</a></li>
                    <li class="breadcrumb-item active">Deleted Customer List</li>
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
                        <tr>
                            <th>Sl No.</th>
                            <th>name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer_infos as $customer_info)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $customer_info->name }}</td>
                                <td>{{ $customer_info->phone }}</td>
                                <td>{{ $customer_info->email }}</td>
                                <td>{{ $customer_info->deleted_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('customer.restore',$customer_info->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fas fa-trash-restore"></i> </a>
                                    <a href="{{ route('customer.forcedelete',$customer_info->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
                                </td>
                            </tr>
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
        @if(Session::has('editsuccess'))
            // Display a success toast, with a title
            toastr.success('Your Edit Successfully', 'Congratulation!')
        @endif

        @if(Session::has('softdeletesuccess'))
            // Display a success toast, with a title
            toastr.success('Your Soft Delete Successfully', 'Congratulation!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection
