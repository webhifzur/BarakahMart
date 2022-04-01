@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Perchase</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Perchase</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form id="form_data" name="form_data" class="form-horizontal" method="POST" action="{{ route('purchase.invoice') }}">
                @csrf
                <div class="card-box">
                    <div class="form-group row m-b-20">
                        <div class="col-lg-2 col-md-2 col-sm-12 bg-primary">
                            <label class="cust_info text-white pt-1 ml-2" style="font-size: 18px">Vendor Info</label>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <select id="vendor" class="form-control" name="vendor_id">
                                <option hidden disabled selected>Select Vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                                
                            </select>
                            @error('vendor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <input id="vendor_phone" class="form-control" type="text" name="vendor_phone" value="" placeholder="Vendor Phone">
                            @error('vendor_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="product_search_form form-group row m-b-20">
                        <div class="col-lg-2 col-md-2 col-sm-4 bg-primary product_search">
                            <label class="text-white pt-2 ml-2" style="font-size: 16px">Product Search</label>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <select class="form-control product_id" id="product_id" name="product_id" required>
                                <option hidden disabled selected>Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <select class="form-control" id="brand_id" name="brand_id">
                                <option hidden disabled selected>Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <select class="form-control" id="unit" name="unit">
                                <option hidden disabled selected>Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <select class="form-control" id="shop_type" name="shop_type">
                                <option hidden disabled selected>shop type</option>
                                @foreach ($shop_types as $shop_type)
                                    <option value="{{ $shop_type->id }}">{{ $shop_type->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="product_search_form form-group row m-t-20">
                        <div class="col-lg-2 col-md-2 col-sm-4"></div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <input class="form-control" type="number" id="buy_price" name="buy_price" value="" placeholder="buy price">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <input class="form-control" type="number" id="sell_price" name="sell_price" value="" placeholder="sell price">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <input class="form-control" type="number" step=".001" id="product_qty" name="product_qty" value="" placeholder="Quantity" min="0" required>
                            @error('product_qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <button id="addproduct" class="btn btn-block btn-custom waves-effect waves-light addproduct" type="button">Add Product</button>
                        </div>
                    </div>
                </div>
                <div class="row m-b-20">
                    <div class="col-lg-8 col-md-8 col-sm-12 table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="data_table">
                            <thead>
                                <tr class="text-center">
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="addrow" id="addrow">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table class="table table-bordered" style="border:1px solid rgb(242,242,242) !important;">
                            <tbody>
                                <tr style="background: lightgray;border-radius: 5px;">
                                    <th colspan="2" style="text-align: center;">
                                        Payment Calculation
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Sub Total</th>
                                    <th style="text-align: center;" >
                                        <input type="text" id="subtotal" value="0" autocomplete="off" readonly class="subTotal form-control rightAlign" name="subTotal">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Pre Ammount</th>
                                    <th style="text-align: center;" >
                                        <input type="number" id="pre_ammount" value="0" readonly class="subTotal form-control rightAlign" name="pre_ammount">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Total</th>
                                    <th style="text-align: center;" >
                                        <input type="number" id="total" value="0" readonly class="subTotal form-control rightAlign" name="total">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Cash</th>
                                    <th style="text-align: center;" >
                                        <input id="cash" value="0" autocomplete="off" class="cash form-control rightAlign" name="cash">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Return</th>
                                    <th style="text-align: center;" >
                                        <input id="return_taka" value="0" autocomplete="off" class="return_taka form-control rightAlign" name="return_taka">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Due</th>
                                    <th style="text-align: center;" >
                                        <input id="due" value="0" autocomplete="off" class="due form-control rightAlign" name="due" min="0" readonly>
                                    </th>
                                </tr>
                                <tr id="div7">
                                    <th style="text-align: center;" colspan="2">
                                        <button id="payment" type="button" class="btn btn-block btn-success payment">Payment</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('content.script')
    <script>
        //select2 js
        $(document).ready(function() {
            $('#customer').select2();
            $('#product_id').select2();
            $('#product_coad').select2();
        });
    </script>
    <script>
        $(document).ready(function(){
            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#vendor').change(function(){
                var vendor = $(this).val();
                $.ajax({
                    type :'POST',
                    url : '/get/vendor/phone',
                    data : { vendor:vendor },
                    success : function (data) {
                        $('#vendor_phone').val(data['phone']);
                    }
                });
            });
            $('#vendor').change(function(){
                var vendor = $(this).val();
                $.ajax({
                    type :'POST',
                    url : '/get/vendor/due',
                    data : { vendor:vendor },
                    success : function (data) {
                        if(data['due']){
                            $('#pre_ammount').val(data['due']);
                        }else{
                            $('#pre_ammount').val(0);
                        }
                    }
                });
            });
        });
    </script>

    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="brand_id[]" value="@{{ brand_id }}" readonly>
            @{{ brand_id }}
            <input type="hidden" name="sell_price[]" value="@{{ sell_price }}" readonly>
            @{{ sell_price }}
           
            <td>
                <input type="hidden"  name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td>
                <input type="hidden" name="buy_price[]" value="@{{ buy_price }}" readonly>
                @{{ buy_price }}
            </td>
            <td>
                <input type="hidden" name="product_qty[]" value="@{{ product_qty }}" readonly>
                @{{ product_qty }}
            </td>
            <td>
                <input type="hidden" name="unit[]" value="@{{ unit }}" readonly>
                @{{ unit }}
            </td>
            <td>
                <input class="product_total" type="hidden" name="product_total[]" value="@{{ product_total }}" readonly>
                @{{ product_total }}
            </td>
            <td>
                <i class="btn btn-danger removeeventmore">delete</i>
            </td>
        </tr>
    </script>
    
    <script>
        $(document).ready(function(){
            $(document).on('keyup' , '#product_qty' , function(e){
                if(e.keyCode === 13){
                    var vendor = $('#vendor').val();
                    var vendor_name = $('#vendor').find('option:selected').text();
                    var product_id = $('#product_id').val();
                    var product_name = $('#product_id').find('option:selected').text();

                    var brand_id = $('#brand_id').val();
                    var buy_price = $('#buy_price').val();
                    var sell_price = $('#sell_price').val();
                    var product_qty = $('#product_qty').val();
                    var unit = $('#unit').val();
                    var product_total = buy_price * product_qty;
                    // Start Validation
                    if(vendor ==null){
                        toastr.warning('Vendor name is empty');
                        return false;
                    }
                    if(product_name=='Select Product'){
                        toastr.warning('product name is empty');
                        return false;
                    }
                    if(brand_id==null){
                        toastr.warning('brand_id name is empty');
                        return false;
                    }
                    if(buy_price==''){
                        toastr.warning('buy price price is empty!');
                        return false;
                    }
                    if(sell_price==''){
                        toastr.warning('sell price price is empty!');
                        return false;
                    }
                    if(product_qty ==''){
                        toastr.warning('product quantity is empty!');
                        return false;
                    }
                    if(unit ==null){
                        toastr.warning('Unit is empty!');
                        return false;
                    }
                    // End Validation 

                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var data = {
                        product_id:product_id,
                        product_name:product_name,
                        brand_id:brand_id,
                        buy_price:buy_price,
                        sell_price:sell_price,
                        product_qty:product_qty,
                        unit:unit,
                        product_total:product_total,
                    };
                    var html = template(data);
                    $('#addrow').append(html);
                    totalAmountPrice();
                }
            });

            $(document).on("click" , ".addproduct" , function(){
                var vendor = $('#vendor').val();
                var vendor_name = $('#vendor').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();

                var brand_id = $('#brand_id').val();
                var buy_price = $('#buy_price').val();
                var sell_price = $('#sell_price').val();
                var product_qty = $('#product_qty').val();
                var unit = $('#unit').val();
                var product_total = buy_price * product_qty;
                // Start Validation
                if(vendor ==null){
                    toastr.warning('Vendor name is empty');
                    return false;
                }
                if(product_name=='Select Product'){
                    toastr.warning('product name is empty');
                    return false;
                }
                if(brand_id==null){
                    toastr.warning('brand_id name is empty');
                    return false;
                }
                if(buy_price==''){
                    toastr.warning('buy price price is empty!');
                    return false;
                }
                if(sell_price==''){
                    toastr.warning('sell price price is empty!');
                    return false;
                }
                if(product_qty ==''){
                    toastr.warning('product quantity is empty!');
                    return false;
                }
                if(unit ==null){
                    toastr.warning('Unit is empty!');
                    return false;
                }
                // End Validation 

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    product_id:product_id,
                    product_name:product_name,
                    brand_id:brand_id,
                    buy_price:buy_price,
                    sell_price:sell_price,
                    product_qty:product_qty,
                    unit:unit,
                    product_total:product_total,
                };
                var html = template(data);
                $('#addrow').append(html);
                totalAmountPrice();
            });
            
            $(document).on("click", ".removeeventmore", function (event){
               $(this).closest(".delete_add_more_item").remove();

               totalAmountPrice();
            });

            $(document).on('keyup click', '#cash', function(e){
                if(e.keyCode === 13){
                    document.getElementById("return_taka").focus();
                }
                totalAmountPrice();
            });

            $(document).on('keyup click', '#return_taka', function(e){
                if(e.keyCode === 13){
                    var subtotal = $('#subtotal').val();
                    if(subtotal == 0){
                        toastr.warning('please add any item');
                        return false;
                    }else{
                        document.forms['form_data'].submit();
                    }
                }
                totalAmountPrice();
            });

            function totalAmountPrice(){
                var sum = 0;
                var total = 0;
                var pre_ammount = 0;
                $(".product_total").each(function (){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum+= parseFloat(value);
                    }
                });
                $('#subtotal').val(sum);
                
                var subtotal = $('#subtotal').val();
                var pre_ammount = $('#pre_ammount').val();
                var total = parseFloat(pre_ammount) + parseFloat(subtotal);
                $('#total').val(total);

                var cash = parseFloat($('#cash').val());
                    if(!isNaN(cash) && cash.length != 0){
                    total -= parseFloat(cash);
                }
                
                var return_taka = $('#return_taka').val();
                   if(!isNaN(return_taka) && return_taka.length != 0){
                    total += parseFloat(return_taka);
                }
                
                $('#due').val(total);
            }

            $(document).on("click" , "#payment" , function(){
                var subtotal = $('#subtotal').val();
                if(subtotal == 0){
                    toastr.warning('please add any item');
                    return false;
                }
                document.forms['form_data'].submit();
            });
        });
    </script>
@endsection