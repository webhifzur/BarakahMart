@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product Add</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active">Product Add</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $shop_type }}" name="shop_type">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ old('name') }}">
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Coad</label>
                <input type="text" class="form-control" name="product_coad" placeholder="Product Coad" value="{{ old('product_coad') }}">
            </div>
            @error('product_coad')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">MRP Price</label>
                <input type="text" class="form-control" name="mrp" placeholder="MRP Price" value="{{ old('mrp') }}">
            </div>
            @error('mrp')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Sub Category</label>
                <select class="form-control" name="subcategory">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->type }}</option>
                    @endforeach
                </select>
            </div>
            @error('subcategory')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Image</label>
                <span class="text-danger">(700px/700px)</span>
                <input id="file-input" type="file" class="form-control" name="image" placeholder="Product Image" onchange="photoChange(this)">
                <img class="ml-5" src="" alt="" id="photo">
            </div>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Video Link</label>
                <input id="file-input" type="text" class="form-control" name="video" placeholder="Product video link">
            </div>
            @error('video')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <h6>Product Small Description</h6>
                <textarea type="text" class="form-control" maxlength="100" name="small_description"></textarea>
            </div>
            @error('small_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <h6>Product Long Description</h6>
                <textarea type="text" class="form-control" name="long_description"></textarea>
            </div>
            @error('long_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-12 col-sm-12 col-12 card-box">
                <h4 class="header-title m-t-0">Slider Image<span class="text-danger">(700px/700px)</span></h4>
                <div class="p-20 p-b-0">
                    <div class="form-group clearfix">
                        <div class="col-sm-12 padding-left-0 padding-right-0">
                            <input type="file" name="slider_image[]" id="filer_input1" multiple="multiple">
                        </div>
                    </div>
                </div>
            </div>
            @error('slider_image')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="form-group account-btn text-center m-t-10">
                <div class="col-12">
                    <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('content.script')

    <script type="text/javascript">
        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>
    
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
        }
        function photoChangEdit(input) {
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
        }
        
        @if(Session::has('addsuccess'))
            // Display a success toast, with a title
            toastr.success('Product Add Successfully', 'Congratulation!')
        @endif

        @if(Session::has('editsuccess'))
            // Display a success toast, with a title
            toastr.success('Product Edit Successfully', 'Congratulation!')
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