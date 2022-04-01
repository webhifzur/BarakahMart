@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">POS</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">POS</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form id="form_data" name="form_data" class="form-horizontal" method="POST" action="{{ route('invoicestore') }}">
                @csrf
                <div class="card-box">
                    <div class="form-group row m-b-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>Customer</label>
                            <select class="form-control" name="customer_type" id="customer_type">
                                <option value="2" id="walk_customer">Walk Customer</option>
                                <option value="1" id="save_customer">Save Customer</option>
                            </select>
                            @error('customer_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label>Sale Date</label>
                            <input id="invioce_date" class="form-control" name="invioce_date" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div id="savecustomerdiv" class="form-group row m-b-20">
                        <div class="col-lg-2 col-md-2 col-sm-12 bg-primary">
                            <label class="cust_info text-white pt-1 ml-2" style="font-size: 18px">Customer Info</label>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <select id="customer" class="form-control" name="customer_id">
                                <option hidden disabled selected>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                                
                            </select>
                            @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <input id="customer_phone" class="form-control" type="text" name="customer_phone" value="" placeholder="Customer Phone">
                            @error('customer_phone')
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
                            <select class="form-control" id="product_coad" name="product_coad">
                                <option hidden disabled selected>Product Coad</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_coad }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <input class="form-control" type="number" id="unit_price" name="unit_price" value="" placeholder="unit price">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4">
                            <input type="hidden" id="qty" name="qty" value="">
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
                                        <input type="number" id="subtotal" value="0" autocomplete="off" readonly class="subTotal form-control rightAlign" name="subTotal">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Pre Ammount</th>
                                    <th style="text-align: center;" >
                                        <input type="number" id="pre_ammount" value="0" value="" readonly class="subTotal form-control rightAlign" name="pre_ammount">
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
                                        <input type="number" id="cash" value="0" autocomplete="off" class="cash form-control rightAlign" name="cash">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Return</th>
                                    <th style="text-align: center;" >
                                        <input type="number" id="return_taka" value="0" autocomplete="off" class="return_taka form-control rightAlign" name="return_taka">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Due</th>
                                    <th style="text-align: center;" >
                                        <input type="number" id="due" value="0" autocomplete="off"  class="due form-control rightAlign" name="due" min="0" readonly>
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
            document.getElementById("savecustomerdiv").style.visibility = "hidden";

            $('#customer_type').change(function(){
                var customer_type = $(this).val();
                if(customer_type != 1){
                    document.getElementById("savecustomerdiv").style.visibility = "hidden";
                }else{
                    document.getElementById("savecustomerdiv").style.visibility = "visible";
                }
            });
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
            
            $('#customer').change(function(){
                var customer = $(this).val();
                $.ajax({
                    type :'POST',
                    url : '/get/customer/phone',
                    data : { customer:customer },
                    success : function (data) {
                        $('#customer_phone').val(data['phone']);
                    }
                });
            });
            $('#customer').change(function(){
                var customer = $(this).val();
                $.ajax({
                    type :'POST',
                    url : '/get/customer/due',
                    data : { customer:customer },
                    success : function (data) {
                        if(data['due']){
                            $('#pre_ammount').val(data['due']);
                        }else{
                            $('#pre_ammount').val(0);
                        }
                    }
                });
            });

            $('#product_id').change(function(){
                var product_id = $(this).val();
                
                $.ajax({
                    type :'POST',
                    url : '/get/unitprice',
                    data : { product_id:product_id },
                    success : function (data) {
                        $('#unit_price').val(data['sell_price']);
                        $('#qty').val(data['qty']);
                    }
                });
            });

            $('#product_coad').change(function(){
                var product_coad = $(this).val();
                
                $.ajax({
                    type :'POST',
                    url : '/get/unitprice/coad',
                    data : { product_coad:product_coad },
                    success : function (data) {
                        document.getElementById("product_id").value = data['id'];
                        document.getElementById("product_id").text = data['name'];
                        $('#unit_price').val(data['sell_price']);
                        $('#qty').val(data['qty']);
                    }
                });
            });
        });
    </script>

    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <td>
                <input type="hidden"  name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td>
                <input type="hidden" name="unit_price[]" value="@{{ unit_price }}" readonly>
                @{{ unit_price }}
            </td>
            <td>
                <input type="hidden" name="product_qty[]" value="@{{ product_qty }}" readonly>
                @{{ product_qty }}
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
                    var customer_type = $('#customer_type').val();
                    var customer_name = $('#customer').find('option:selected').text();
                    var product_id = $('#product_id').val();
                    var product_name = $('#product_id').find('option:selected').text();

                    // document.getElementById("product_id").value = product_id.find(checkAdult);

                    var unit_price = $('#unit_price').val();
                    var product_qty = $('#product_qty').val();
                    var old_qty = $('#qty').val();
                    var qty = old_qty - product_qty;
                    var product_total = unit_price * product_qty;
                    // Start Validation
                    if(customer_type == 1){
                        if(customer_name=='Select Customer'){
                            toastr.warning('customer name is empty');
                            return false;
                        }
                    }
                    if(product_name=='Select Product'){
                        toastr.warning('product name is empty');
                        return false;
                    }
                    if(unit_price==''){
                        toastr.warning('unit price is empty!');
                        return false;
                    }
                    if(product_qty == '' || product_qty == 0){
                        toastr.warning('product quantity is empty!');
                        return false;
                    }
                    if(qty < 0){
                        toastr.warning('product quantity is insufficient . Available quantity is' +' '+ old_qty);
                        return false;
                    }

                    // End Validation 

                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var data = {
                        product_id:product_id,
                        product_name:product_name,
                        unit_price:unit_price,
                        product_qty:product_qty,
                        product_total:product_total,
                    };
                    var html = template(data);
                    $('#addrow').append(html);
                    totalAmountPrice();
                }
            });

            $(document).on("click" , ".addproduct" , function(){
                var customer_type = $('#customer_type').val();
                var customer_name = $('#customer').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();

                // document.getElementById("product_id").value = product_id.find(checkAdult);

                var unit_price = $('#unit_price').val();
                var product_qty = $('#product_qty').val();
                var old_qty = $('#qty').val();
                var qty = old_qty - product_qty;
                var product_total = unit_price * product_qty;
                // Start Validation
                if(customer_type == 1){
                    if(customer_name=='Select Customer'){
                        toastr.warning('customer name is empty');
                        return false;
                    }
                }
                if(product_name=='Select Product'){
                    toastr.warning('product name is empty');
                    return false;
                }
                if(unit_price==''){
                    toastr.warning('unit price is empty!');
                    return false;
                }
                if(product_qty == '' || product_qty == 0){
                    toastr.warning('product quantity is empty!');
                    return false;
                }
                if(qty < 0){
                    toastr.warning('product quantity is insufficient . Available quantity is' +' '+ old_qty);
                    return false;
                }

                // End Validation 

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    product_id:product_id,
                    product_name:product_name,
                    unit_price:unit_price,
                    product_qty:product_qty,
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
                var subtotal = $('#subtotal').val();
                if(e.keyCode === 13){
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

    {{-- toastr js --}}
    <script>
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

        @if(Session::has('error'))
            // Display a success toast, with a title
            toastr.success('Please Add product','Sorry!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection