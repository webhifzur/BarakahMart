@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Deleted Cost</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('expence.index') }}">Cost</a></li>
                    <li class="breadcrumb-item active">Deleted Cost</li>
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
                            <th>Type</th>
                            <th>Taka</th>
                            <th>Deleted by</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expences as $expence)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $expence->type }}</td>
                                <td>{{ $expence->taka }}</td>
                                <td>{{ $expence->user->name }}</td>
                                <td>{{ $expence->deleted_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('expence.restore',$expence->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fas fa-trash-restore"></i> </a>
                                    <a href="{{ route('expence.forcedelete',$expence->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
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
