@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Offer</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Offer</li>
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
                            Add Offer
                        </a>                        
                        <a href="{{ route('offer.restoreview') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>product</th>
                            <th>Image</th>
                            @if (Auth::user()->type == 1)
                                <th>Action</th>
                            @endif
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
                                @if (Auth::user()->type == 1)
                                    <td>
                                        <a href="{{ route('offer.delete',$offer->id) }}" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                        
                    </table>
                    <!--addshop Modal -->
                   <div id="addshop-modal" class="modal-demo">
                       <button type="button" class="close" onclick="Custombox.close();">
                           <span>&times;</span><span class="sr-only">Close</span>
                       </button>
                       <h4 class="custom-modal-title">Add Offer</h4>
                       <div class="custom-modal-text">
                           <form class="form-horizontal" method="POST" action="{{ route('offer.store') }}" enctype="multipart/form-data">
                               @csrf
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Product Select</label>
                                        <select name="product" class="form-control">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                   </div>
                                   @error('product')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                               <div class="form-group m-b-25">
                                   <div class="col-12">
                                       <label for="emailaddress3">Image</label>
                                       <span class="text-danger">(320px/180px)</span>
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
       

        @if(Session::has('addsuccess'))
            // Display a success toast, with a title
            toastr.success('Slider Add Successfully', 'Congratulation!')
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
