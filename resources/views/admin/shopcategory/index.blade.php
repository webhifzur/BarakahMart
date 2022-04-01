@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Shop Category</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Shop Category</li>
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
                        <a href="#addshop-modal" class="ml-3 mr-1 btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                            data-overlaySpeed="100" data-overlayColor="#36404a" style="float:left">
                            Add Shop Category
                        </a>                        
                        <a href="{{ route('shopcategory.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>Type</th>
                            <th>Icon Image</th>
                            <th>Image</th>
                            <th>Created At</th>
                            @if (Auth::user()->type == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shopcategories as $shopcategory)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $shopcategory->type }}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('uploads/'.$shopcategory->image) }}" alt="">
                                </td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('uploads/'.$shopcategory->icon_image) }}" alt="">
                                </td>
                                <td>{{ $shopcategory->created_at->format('d/m/Y') }}</td>
                                @if (Auth::user()->type == 1)
                                    <td>
                                        <a href="#edit-modal{{ $shopcategory->id }}" class="btn btn-icon waves-effect waves-light btn-primary" data-animation="sign" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"><i class="far fa-edit"></i>
                                        </a>
                                        <a href="{{ route('shopcategory.delete',$shopcategory->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
                                    </td>
                                @endif
                            </tr>
                             <!--Edit Modal -->
                            <div id="edit-modal{{ $shopcategory->id }}" class="modal-demo">
                                <button type="button" class="close" onclick="Custombox.close();">
                                    <span>&times;</span><span class="sr-only">Close</span>
                                </button>
                                <h4 class="custom-modal-title">Edit Shop Category Type</h4>
                                <div class="custom-modal-text">
                                    <form class="form-horizontal" method="POST" action="{{ route('shopcategory.edit') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $shopcategory->id }}">
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label for="emailaddress3">Shop Type</label>
                                                <input type="text" class="form-control" name="type" placeholder="Shop Type" value="{{  $shopcategory->type }}">
                                            </div>
                                        </div>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label>Icon Image</label>
                                                <span class="text-danger">(25px/25px)</span>
                                                <input type="hidden" name="icon_old_image" value="{{ $shopcategory->icon_image }}">
                                                <input type="file" class="form-control" name="icon_image" placeholder="Shop Type icon image" onchange="iconChangeEdit(this)">
                                            </div>
                                            @error('icon_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img class="ml-5" src="" alt="" id="iconEdit">
                                        </div>

                                        <div class="form-group m-b-25">
                                            <div class="col-12">
                                                <label>Image</label>
                                                <span class="text-danger">(250px/175px)</span>
                                                <input type="hidden" name="old_image" value="{{ $shopcategory->image }}">
                                                <input type="file" class="form-control" name="image" placeholder="Shop Type Image" onchange="photoChangeEdit(this)">
                                            </div>
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <img class="ml-5" src="" alt="" id="photoEdit">
                                        </div>
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
                   <div id="addshop-modal" class="modal-demo">
                       <button type="button" class="close" onclick="Custombox.close();">
                           <span>&times;</span><span class="sr-only">Close</span>
                       </button>
                       <h4 class="custom-modal-title">Add Shop Type</h4>
                       <div class="custom-modal-text">
                           <form class="form-horizontal" method="POST" action="{{ route('shopcategory.store') }}" enctype="multipart/form-data">
                               @csrf
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Shop Type</label>
                                        <input type="text" class="form-control" name="type" placeholder="Shop Type">
                                   </div>
                                   @error('type')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Icon Image</label>
                                       <span class="text-danger">(25px/25px)</span>
                                        <input type="file" class="form-control" name="icon_image" placeholder="Shop Type icon image" onchange="iconChange(this)">
                                   </div>
                                   @error('icon_image')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                               <img class="ml-5" src="" alt="" id="icon">
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Image</label>
                                       <span class="text-danger">(250px/175px)</span>
                                        <input type="file" class="form-control" name="image" placeholder="Shop Type Image" onchange="photoChange(this)">
                                   </div>
                                   @error('image')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                               <img class="ml-5" src="" alt="" id="photo">
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
    
    <script>
        function iconChange(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#icon')
                    .attr('src', e.target.result)
                    .attr("class","img-thumbnail")
                    .attr("height",'100%')
                    .attr("width",'100%')
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
        function iconChangeEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#iconEdit')
                    .attr('src', e.target.result)
                    .attr("class","img-thumbnail")
                    .attr("height",'100%')
                    .attr("width",'100%')
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        function photoChange(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#photo')
                    .attr('src', e.target.result)
                    .attr("class","img-thumbnail")
                    .attr("height",'100%')
                    .attr("width",'100%')
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
        function photoChangeEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#photoEdit')
                    .attr('src', e.target.result)
                    .attr("class","img-thumbnail")
                    .attr("height",'100%')
                    .attr("width",'100%')
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        @if(Session::has('addsuccess'))
            // Display a success toast, with a title
            toastr.success('Shop Category Add Successfully', 'Congratulation!')
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
