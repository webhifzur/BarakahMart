@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product Edit</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                    <li class="breadcrumb-item active">Product Edit</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="old_image" value="{{ $product->image }}">
        <input type="hidden" name="old_slider_image" value="{{ $product->slider_image }}">
        <input type="hidden" value="{{ $product->shop_type }}" name="shop_type">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ $product->name }}">
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Coad</label>
                <input type="text" class="form-control" name="product_coad" placeholder="Product Coad" value="{{ $product->product_coad }}">
            </div>
            @error('product_coad')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Unit</label>
                <select class="form-control" name="unit">
                    <option disabled selected hidden>Select One</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ $product->unit == $unit->id ? "selected" : "" }}>{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Brand</label>
                <select class="form-control" name="brand">
                    <option disabled selected hidden>Select One</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product->brand == $brand->id ? "selected" : "" }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('brand')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-4 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Sub Category</label>
                <select class="form-control" name="subcategory">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ $product->subcategory == $subcategory->id ? "selected" : "" }}>{{ $subcategory->type }}</option>
                    @endforeach
                </select>
            </div>
            @error('subcategory')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">MRP Price</label>
                <input type="text" class="form-control" name="mrp" placeholder="MRP Price" value="{{ $product->mrp }}">
            </div>
            @error('mrp')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Buy Price</label>
                <input type="text" class="form-control" name="buy_price" placeholder="Product Buy Price" value="{{ $product->buy_price }}">
            </div>
            @error('buy_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product sell Price</label>
                <input type="text" class="form-control" name="sell_price" placeholder="Product sell Price" value="{{ $product->sell_price }}">
            </div>
            @error('sell_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Quantity</label>
                <input type="nubmer" class="form-control" name="qty" placeholder="Product Quantity" value="{{ $product->qty }}">
            </div>
            @error('qty')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Video Link</label>
                <input id="file-input" type="text" class="form-control" name="video" placeholder="Product video link" value="{{ $product->vedio }}">
            </div>
            @error('video')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <label for="emailaddress3">Product Image</label>
                <span class="text-danger">(700px/700px)</span>
                <input id="file-input" type="file" class="form-control" name="image" placeholder="Product Image" onchange="photoChange(this)">
                <img class="ml-5" src="" alt="" id="photo">
            </div>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <h6>Product Small Description</h6>
                <textarea type="text" class="form-control" maxlength="100" name="small_description">{{ $product->small_description }}</textarea>
            </div>
            @error('small_description')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="col-md-6 col-sm-12 col-12 form-group m-b-25">
                <h6>Product Long Description</h6>
                <textarea type="text" class="form-control" name="long_description">{{ $product->long_description }}</textarea>
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
                    <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Update</button>
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
    </script>
@endsection