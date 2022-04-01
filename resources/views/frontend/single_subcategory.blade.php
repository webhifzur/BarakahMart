@extends('layouts.frontend_app')

@section('frontend_content')
@include('layouts.sidebar_responsive_app')

  
    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Single Sub Category</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li><a href="{{ route('single.category',$subcategory->category->slug) }}">{{ $subcategory->category->type }}</a></li>
              <li>></li>
              <li>{{ $subcategory->type }}</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <!-- Product Area HTML Start -->
    <section class="product-area section-padding">
        <div class="container">
          <div id="wrapper">
            <div class="tabs">
              <input hidden type="radio" name="tab-css" id="tab-1" checked />
              <label class="tab-control" for="tab-1">All PRODUCT</label>
              <input hidden type="radio" name="tab-css" id="tab-2" />
              <label class="tab-control" for="tab-2">NEWEST LAUNCHES!</label>
              <input hidden type="radio" name="tab-css" id="tab-3" />
              <label class="tab-control" for="tab-3">BEST SELLING</label>
          
              <div class="tab-content">
                <div id="tab-panel-1" class="tab-panel">
                  <ul>
                    @foreach ($products as $product)
                        <li class="product">
                          <div class="single-product">
                            <div class="image-area">
                                <img src="{{ asset('uploads/'.$product->image) }}" alt="">
                              <div class="overly">
                                <div class="icon">
                                  <ul>
                                    <li><a href="{{ route('single.product',$product->slug) }}"><i class="fas fa-search-plus"></i></a></li>
                                    {{-- <li><a href=""><i class="far fa-heart"></i></a></li> --}}
                                  </ul>
                                </div>
                                <div class="add-cart">
                                  <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="qty-input">
                                        <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                        <input class="product-qty" type="number"  name="product_qty" min="0" max="1000" value="1">
                                        <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    {{-- <input type="hidden" name="product_price" value="{{ $product->sell_price }}"> --}}
                                    <button type="submit" >ADD TO CART</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <div class="text">
                              <a href="{{ route('single.product',$product->slug) }}">{{ $product->name }}</a>
                              <ul>
                                @if ($product->mrp)
                                  <li style="text-decoration: line-through; color: #000033;">Tk {{ $product->mrp }}</li>
                                @endif
                                <li style="color: #ff6633;">Tk {{ $product->sell_price }}</li>
                              </ul>
                            </div>
                          </div>
                        </li>
                    @endforeach
                  </ul>
                </div>
                <div id="tab-panel-2" class="tab-panel">
                  <ul>
                    @foreach ($products as $product)
                    @php
                        $date = Carbon\Carbon::now()->floatDiffInDays($product->updated_at);
                    @endphp
                      @if ($date <= 30)
                        <li class="product">
                          <div class="single-product">
                            <div class="image-area">
                              <img src="{{ asset('uploads/'.$product->image) }}" alt="">
                              <div class="overly">
                                <div class="icon">
                                  <ul>
                                    <li><a href="{{ route('single.product',$product->slug) }}"><i class="fas fa-search-plus"></i></a></li>
                                    {{-- <li><a href=""><i class="far fa-heart"></i></a></li> --}}
                                  </ul>
                                </div>
                                <div class="add-cart">
                                  <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="qty-input">
                                        <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                        <input class="product-qty" type="number"  name="product_qty" min="0" max="1000" value="1">
                                        <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    {{-- <input type="hidden" name="product_price" value="{{ $product->sell_price }}"> --}}
                                    <button type="submit" >ADD TO CART</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <div class="text">
                              <a href="{{ route('single.product',$product->slug) }}">{{  $product->name  }}</a>
                              <ul>
                                @if ($product->mrp)
                                  <li style="text-decoration: line-through; color: #000033;">Tk {{ $product->mrp }}</li>
                                @endif
                                <li style="color: #ff6633;">Tk {{ $product->sell_price }}</li>
                              </ul>
                            </div>
                          </div>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
                <div id="tab-panel-3" class="tab-panel">
                  <ul>
                    @foreach ($products as $product)
                        <li class="product">
                          <div class="single-product">
                            <div class="image-area">
                              <img src="{{ asset('uploads/'.$product->image) }}" alt="">
                              <div class="overly">
                                <div class="icon">
                                  <ul>
                                    <li><a href="{{ route('single.product',$product->slug) }}"><i class="fas fa-search-plus"></i></a></li>
                                    {{-- <li><a href=""><i class="far fa-heart"></i></a></li> --}}
                                  </ul>
                                </div>
                                <div class="add-cart">
                                  <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="qty-input">
                                        <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                        <input class="product-qty" type="number"  name="product_qty" min="0" max="1000" value="1">
                                        <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    {{-- <input type="hidden" name="product_price" value="{{ $product->sell_price }}"> --}}
                                    <button type="submit" >ADD TO CART</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <div class="text">
                              <a href="{{ route('single.product',$product->slug) }}">{{ $product->name  }}</a>
                              <ul>
                                @if ($product->mrp)
                                  <li style="text-decoration: line-through; color: #000033;">Tk {{ $product->mrp }}</li>
                                @endif
                                <li style="color: #ff6633;">Tk {{ $product->sell_price }}</li>
                              </ul>
                            </div>
                          </div>
                        </li>
                    @endforeach
                  </ul>
                 
                </div>
              </div>
            </div>
          </div>
          <nav aria-label="Page navigation example" style="padding: 30px 0 50px;">
            {{ $products->links('frontend.pagination') }}
          </nav>
        </div>
    </section>
    <!-- Product Area HTML End -->

     @include('layouts.footer_app')
    
@endsection