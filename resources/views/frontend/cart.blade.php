@extends('layouts.frontend_app')

@section('frontend_content')
@include('layouts.sidebar_responsive_app')

    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Product Cart</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li>Chart</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <section class="cart-area">
        <div class="container">
          <form action="{{ route('cartupdate') }}" method="POST">
            @csrf
            <table>
                <thead>
                  <tr style="background-color: #f2f2f2;">
                    <th scope="col"></th>
                    <th scope="col">Product</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $sub_total = 0;
                  @endphp
                    @foreach(cart_items() as $cart_item)
                      <tr>
                        <td data-label="Prodect" class="image-wrapper"><img src="{{ asset('uploads/'.$cart_item->relationship_with_cart->image) }}" alt=""></td>
                        <td data-label="Name" style="text-align: left; font-size: 18px; font-weight: 600;">{{ $cart_item->relationship_with_cart->name }}</td>
                        <td data-label="PRICE"> Tk {{ $cart_item->relationship_with_cart->sell_price }}</td>
                        <td data-label="QUANTITY">
                            <div class="qty-input">
                                <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                <input class="product-qty" type="number" name="product_qty[{{ $cart_item->id }}]" min="0" max="1000" value="{{ $cart_item->product_qty }}">
                                <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                            </div>
                        </td>
                        <td data-label="TOTAL">TK {{ $cart_item->product_qty * $cart_item->relationship_with_cart->sell_price }}</td>
                        <td><a href="{{ route('cartremove', $cart_item->id) }}"><i class="far fa-trash-alt text-danger"></i></a></td>
                      </tr>
                      @php
                        $sub_total = $sub_total + ($cart_item->product_qty * $cart_item->relationship_with_cart->sell_price)
                      @endphp
                    @endforeach
                </tbody>
              </table>
              <div class="btn-area">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-lg-6 col-6 text-start">
                          <a class="cart_update" href="{{ route('productpage') }}"><i class="far fa-arrow-alt-circle-left"></i> Continue shopping</a>
                      </div>
                      <div class="col-md-6 col-sm-6 col-lg-6 col-6 text-end">
                          <button type="submit" class="cart_update"><i class="fas fa-sync"></i> Update</button>
                      </div>
                  </div>
              </div>
          </form>
              <div class="subtotal-area">
                  <h4>SUBTOTAL <span>Tk {{ $sub_total }}</span></h4>
                  @php
                    session([ 'sub_total' => $sub_total ])
                  @endphp
                  <p>Shipping & taxes calculated at checkout</p>
                  <a href="{{ route('checkoutpage') }}">CHECKOUT</a>
              </div>
        </div>
    </section>
    @include('layouts.footer_app')
    
@endsection

@section('script_content')
@endsection
    