@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Area</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Area</li>
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
                        <a href="#addarea-modal" class="ml-3 mr-1 btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                            data-overlaySpeed="100" data-overlayColor="#36404a" style="float:left">
                            Add area
                        </a>
                        <a href="{{ route('area.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="#edit-modal{{ $area->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                       data-overlaySpeed="100" data-overlayColor="#36404a"><i class="far fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('area.destroy',$area->id) }}" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>
                             <!--Edit Modal -->
                            <div id="edit-modal{{ $area->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">Edit area</h4>
                                <div class="custom-modal-text">
                                    <form class="form-horizontal" method="POST" action="{{ route('area.update',$area->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $area->id }}">
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">area</label>
                                                <input type="text" class="form-control" name="name" placeholder="Shop Type" value="{{  $area->name }}">
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">City name</label>
                                                <select class="form-control" name="city_id" id="">
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @error('city_id')
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
                   <div id="addarea-modal" class="modal-demo">
                       <button type="button" class="close" onclick="Custombox.close();">
                           <span>&times;</span><span class="sr-only">Close</span>
                       </button>
                       <h4 class="custom-modal-title">Add area</h4>
                       <div class="custom-modal-text">
                           <form class="form-horizontal" method="POST" action="{{ route('area.store') }}">
                               @csrf
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">area Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="area Name">
                                   </div>
                               </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">City name</label>
                                        <select class="form-control" name="city_id" id="">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                   </div>
                               </div>
                                @error('city_id')
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
            toastr.success('area Add Successfully', 'Congratulation!')
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
