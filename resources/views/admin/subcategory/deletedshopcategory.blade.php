@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Deleted SubCategory</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">SubCategory</a></li>
                    <li class="breadcrumb-item active">Deleted SubCategory</li>
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
                            <th>SubCategory Name</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $subcategory->type }}</td>
                                <td>{{ $subcategory->category->type }}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('uploads/'.$subcategory->image) }}" alt="">
                                </td>
                                <td>{{ $subcategory->deleted_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('subcategory.restore',$subcategory->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fas fa-trash-restore"></i> </a>
                                    <a href="{{ route('subcategory.forcedelete',$subcategory->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
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
