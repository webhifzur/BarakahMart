@extends('layouts.frontend_app')

@section('frontend_content')
@include('layouts.sidebar_responsive_app')

    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Checkout</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li>Checkout</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <!-- checkout Area HTML Start -->
    <section class="checkout-area" style="padding: 50px 0;">
        <div class="container">
            <div class="checkout-from">
               <div class="row">
                   <div class="col-lg-8">
                        <div class="title">
                           <h2>Billing Details</h2>
                        </div>
                    <form method="POST" action="{{ route('order.place') }}">
                      @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">First Name*</label>
                                <input type="name" class="form-control" name="fname" value="{{ old('fname') }}">
                                @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Last Name*</label>
                                <input type="name" class="form-control" name="lname" value="{{ old('lname') }}">
                                @error('lname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Phone No*</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputEmail1" class="form-label">Country*</label>
                                <select class="form-select" aria-label="Default select example" name="country">
                                  <option value="1" selected>Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputEmail1" class="form-label">Your Address*</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1" class="form-label">Pstcode/ZIP</label>
                                <input type="number" class="form-control" name="zipcode" value="{{ old('zipcode') }}">
                                @error('zipcode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Town/City*</label>
                              <select class="form-select" aria-label="Default select example" name="city_id">
                                @foreach ($cities as $city)
                                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                              </select>
                              @error('city_id')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                            <div class="col-lg-12 mb-3 mt-3">
                              <label for="chkPassport" style="margin-bottom: 10px;">
                                <input type="checkbox" class="form-check-input" id="chkPassport" name="s_check" value="1">
                                <span>SHIP TO A DIFFERENT ADDRESS?</span>
                              </label>
                              <div id="dvPassport" style="display: none">
                                  <div class="row">
                                    
                            <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">First Name*</label>
                              <input type="name" class="form-control" name="s_fname" value="{{ old('s_fname') }}">
                              @error('s_fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                          </div>
                          <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Last Name*</label>
                              <input type="name" class="form-control" name="s_lname" value="{{ old('s_lname') }}">
                              @error('s_lname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                          </div>
                          <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Email address*</label>
                              <input type="email" class="form-control" name="s_email" value="{{ old('s_email') }}">
                              @error('s_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                          </div>
                          <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Phone No*</label>
                              <input type="number" class="form-control" name="s_phone" value="s_phone">
                              @error('s_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                          </div>
                          <div class="col-lg-12">
                              <label for="exampleInputEmail1" class="form-label">Country*</label>
                              <select class="form-select" aria-label="Default select example" name="s_country" >
                                <option value="1" selected>Bangladesh</option>
                              </select>
                          </div>
                          <div class="col-lg-12">
                              <label for="exampleInputEmail1" class="form-label">Your Address*</label>
                              <input type="text" class="form-control" name="s_address" value="s_address">
                              @error('s_address')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Pstcode/ZIP</label>
                              <input type="number" class="form-control" name="s_zipcoad" value="s_zipcoad">
                              @error('s_zipcoad')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-lg-6">
                              <label for="exampleInputEmail1" class="form-label">Town/City*</label>
                              <select class="form-select" aria-label="Default select example" name="s_city_id">
                                @foreach ($cities as $city)
                                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                              </select>
                              @error('s_city_id')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                                  </div>
                              </div>
                              <div id="AddPassport">
                                  
                              </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="exampleInputEmail1" class="form-label">Order Notes</label>
                                <textarea name="note" id="" cols="30" rows="10" placeholder="Notes about Your Order, e.g.Special Note for Delivery">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="check-right">
                          <div class="title">
                              <h2>Your Order</h2>
                          </div>
                          <ul>
                            @foreach(cart_items() as $cart_item)
                              <li>{{ $cart_item->relationship_with_cart->name }}<span>৳{{ $cart_item->product_qty * $cart_item->relationship_with_cart->sell_price }}</span></li>
                              <input type="hidden" name="product_id[]" value="{{  $cart_item->product_id }}">
                              <input type="hidden" name="product_name[]" value="{{ $cart_item->relationship_with_cart->name }}">
                              <input type="hidden" name="product_qty[]" value="{{ $cart_item->product_qty }}">
                              <input type="hidden" name="product_price[]" value="{{ $cart_item->relationship_with_cart->sell_price }}">
                            @endforeach

                              @php
                                  $shipping = 0;
                              @endphp
                              <li>Subtotal <span style="font-weight: 700;">৳{{ session('sub_total') }}</span></li>
                              <li>Shipping <span>৳{{ $shipping }}</span></li>
                              <li style="font-weight: 700;">Total <span>৳{{ session('sub_total') - $shipping }}</span></li>
                              <input type="hidden" name="subtotal" value="{{ session('sub_total') }}">
                              <input type="hidden" name="shipping" value="{{ $shipping }}">
                              <input type="hidden" name="total" value="{{ session('sub_total') - $shipping }}">
                          </ul>
                          <div class="checkbox-area">
                              <div class="row">
                                  {{-- <div class="col-lg-12 mb-2">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                      <label class="form-check-label" for="exampleCheck1">Credit Card</label>
                                  </div> --}}
                                  <div class="col-lg-12 mb-2">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1" checked name="pay_type" value="1">
                                      <label class="form-check-label" for="exampleCheck1">Cash on Delivery</label>
                                       @error('pay_type')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="col-lg-12">
                                      <button type="submit">Place Order</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                   </form>
               </div>
            </div>
        </div>
    </section>
    <!-- checkout Area HTML End -->
    @include('layouts.footer_app')
    
@endsection

@section('script_content')
@endsection