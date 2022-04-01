@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Offer</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('offer.index') }}">Offer</a></li>
                    <li class="breadcrumb-item active">Offer Deleted</li>
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
                            <th>product</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $offer->product->name }}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('uploads/'.$offer->image) }}" alt="" width="200px" height="200px">
                                </td>
                                <td>
                                    <a href="{{ route('offer.restore',$offer->id) }}" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fas fa-trash-restore"></i> </a>
                                    <a href="{{ route('offer.forcedelete',$offer->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
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
