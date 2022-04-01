@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Cost</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Cost</li>
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
                        <a href="#addexpence-modal" class="ml-3 mr-1 btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                            data-overlaySpeed="100" data-overlayColor="#36404a" style="float:left">
                            Add Cost
                        </a>
                        <a href="{{ route('expence.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>Type</th>
                            <th>Taka</th>
                            <th>Created By</th>
                            <th>Created At</th>
                             @if (Auth::user()->type == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expences as $expence)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $expence->type }}</td>
                                <td>{{ $expence->taka }}</td>
                                <td>{{ $expence->user->name }}</td>
                                <td>{{ $expence->created_at->format('d/m/Y') }}</td>
                                @if (Auth::user()->type == 1)
                                    <td>
                                        <a href="#edit-modal{{ $expence->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"><i class="far fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('expence.destroy',$expence->id) }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                             <!--Edit Modal -->
                            <div id="edit-modal{{ $expence->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">Edit Cost</h4>
                                <div class="custom-modal-text">
                                    <form class="form-horizontal" method="POST" action="{{ route('expence.update',$expence->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $expence->id }}">
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">Cost Type</label>
                                                <input type="text" class="form-control" name="type" placeholder="Cost Type" value="{{  $expence->type }}">
                                            </div>
                                        </div>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">Cost Taka</label>
                                                <input type="number" class="form-control" name="taka" placeholder="Cost Type" value="{{  $expence->taka }}">
                                            </div>
                                        </div>
                                        @error('taka')
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
                   <div id="addexpence-modal" class="modal-demo">
                       <button type="button" class="close" onclick="Custombox.close();">
                           <span>&times;</span><span class="sr-only">Close</span>
                       </button>
                       <h4 class="custom-modal-title">Add Cost</h4>
                       <div class="custom-modal-text">
                           <form class="form-horizontal" method="POST" action="{{ route('expence.store') }}">
                               @csrf
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Cost Type</label>
                                        <input type="text" class="form-control" name="type" placeholder="Cost type">
                                   </div>
                               </div>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Cost Taka</label>
                                        <input type="number" class="form-control" name="taka" placeholder="Cost taka">
                                   </div>
                               </div>
                                @error('taka')
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
            toastr.success('expence Add Successfully', 'Congratulation!')
        @endif

        @if(Session::has('editsuccess'))
            // Display a success toast, with a title
            toastr.success('expence Edit Successfully', 'Congratulation!')
        @endif

        @if(Session::has('softdeletesuccess'))
            // Display a success toast, with a title
            toastr.success('Your Soft Delete Successfully', 'Congratulation!')
        @endif

        @if(Session::has('restoresuccess'))
            // Display a success toast, with a title
            toastr.success('Your Restore Successfully', 'Congratulation!')
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
