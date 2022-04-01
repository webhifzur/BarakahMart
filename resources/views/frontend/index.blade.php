@extends('layouts.frontend_app')
@section('frontend_content')
    @include('layouts.sidebar_app')
    
    <div class="content-box">
      
      <!-- Hero Area HTML Start -->
      <div class="hero-area">
          <div class="slider">
            @foreach ($sliders as $slider)
              <div class="bg-1">
                <img class="img-fluid" src="{{ asset('uploads/'.$slider->image) }}" alt="">
              </div>
            @endforeach
          </div>
      </div>
      <!-- Hero Area HTML End -->

      <!-- Category Area HTML Start -->
      <section class="category-area section-padding">
        <div class="container">
          <div class="section-title">
            <h2>{{ setting()->c_title }}</h2>
          </div>
          <div class="row">
            @foreach ($categories as $category)
              <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6">
                <a href="{{ route('single.category',$category->slug) }}">
                  <div class="single-category">
                    <img src="{{ asset('uploads/'.$category->image) }}" alt="">
                  </div>
                </a>
              </div>
            @endforeach
            {{-- <div class="col-lg-12">
              <div class="more-btn">
                <a href="product.html">View More</a>
              </div>
            </div> --}}
          </div>
        </div>
      </section>
      <!-- Category Area HTML End -->

      <!-- Product Area HTML Start -->
      <section class="product-area section-padding">
        <div class="container">
          <div class="section-title">
            <h2>{{ setting()->p_title }}</h2>
            <p>{{ setting()->p_subtitle }}</p>
          </div>
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
                                <img src="{{ asset('uploads/'.$product->image) }}" alt="" class="img-fluid">
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
                                    <button type="submit" >ADD TO CART</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <div class="text">
                              <a href="{{ route('single.product',$product->slug) }}">{!! $product->name !!}</a>
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
                              <img src="{{ asset('uploads/'.$product->image) }}" alt="" class="img-fluid">
                              <div class="overly">
                                <div class="icon">
                                  <ul>
                                    <li><a href=""><i class="fas fa-search-plus"></i></a></li>
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
                              <a href="{{ route('single.product',$product->slug) }}">{!! $product->name !!}</a>
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
                              <img src="{{ asset('uploads/'.$product->image) }}" alt="" class="img-fluid">
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
                             <a href="{{ route('single.product',$product->slug) }}">{!! $product->name !!}</a>
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
            <div class="more-btn" style="margin-top: 30px;"> 
              <a href="{{ route('productpage') }}">View More</a>
            </div>
        </div>
      </section>
      <!-- Product Area HTML End -->

      <!-- Brand Area HTML Start -->
      <section class="brand-area section-padding" id="offer">
        <div class="container">
          <div class="section-title">
            <h2>{{ setting()->offer_title }}</h2>
          </div>
          <div class="customer-logos wow fadeInUp">
            @foreach ($offers as $offer)
              <div class="slide">
                <div class="row">
                  <div class="col-md-8 col-12 col-sm-12">
                    <img src="{{ asset('uploads/'.$offer->image) }}" alt="">
                  </div>
                  <div class="col-md-4 col-12 col-sm-12">
                    <div class="cart-gird">
                      <img src="{{ asset('uploads/'.$offer->product->image) }}" alt="image" style="width: 100%;">
                      <h5>{{ $offer->product->name }}</h5>
                       @if ($product->mrp)
                          <span style="text-decoration: line-through; color: #000033;">Tk {{ $product->mrp }}</span>
                        @endif
                        <span>Tk {{ $offer->product->sell_price }}</span>
                      <div class="overly">
                        <a class="details" href="{{ route('single.product',$offer->product->slug) }}">Details</a>
                      </div>
                    </div>
                    <form method="POST" action="{{ route('cart.store') }}">
                      @csrf
                      <div class="qty-input">
                          <input class="product-qty" type="hidden"  name="product_qty" value="1">
                      </div>
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <button type="submit" class="cart">ADD TO CART</button>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
      <!-- Brand Area HTML End -->
      @include('layouts.footer_app')
    </div>
@endsection
@section('script_content')
    {{-- toastr js --}}
    <script>
        @if(Session::has('registersuccess'))
            // Display a success toast, with a title
            toastr.success('register Successfully', 'Congratulation!')
        @endif
    </script>
@endsection