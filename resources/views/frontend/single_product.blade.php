@extends('layouts.frontend_app')

@section('frontend_content')
@include('layouts.sidebar_responsive_app')
    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
        <div class="container">
          <div class="text">
            <h1>Products Details</h1>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>></li>
                <li>Single Product</li>
            </ul>
          </div>
        </div>
    </div>
    <!-- Inner Banner HTML End -->

    <!-- Single Product HTML Start -->
    <section class="single-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="product-images">
                      <div class="product-active owl-carousel">
                        <div class="item">
                          <img src="{{ asset('uploads/'.$product->image) }}" alt="" width="500px" height="350px">
                        </div>
                        @if ($product->slider_image)
                          @foreach(json_decode($product->slider_image ,true) as $image)
                            <div class="item">
                              <img src="{{ asset('uploads/'.$image) }}" alt="" data-full-alt="" width="500px" height="350px">
                            </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="product-thumbnil-active  owl-carousel mt-3">
                        @if ($product->slider_image)
                          <div class="item">
                            <img src="{{ asset('uploads/'.$product->image) }}" alt="">
                          </div>
                          @foreach(json_decode($product->slider_image ,true) as $image)
                            <div class="item">
                              <img src="{{ asset('uploads/'.$image) }}" alt="" data-full-alt="">
                            </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="product-details">
                        <h2>{{ $product->name }}</h2>
                        @if ($product->qty >= 1)
                          <h6>In Stock</h6>
                        @else 
                          <h6>Out Of Stock</h6>
                        @endif
                        <div class="star">
                          @if (!count($reviews) == 0)
                            @for ($i = 1; $i <= round($stars/count($reviews)); $i++)
                              <i class="fas fa-star"></i>
                            @endfor
                          @else
                            <h6>new arrival</h6>
                          @endif
                          <span>({{ count($reviews) }} reviews)</span>
                        </div>
                        <span>
                          @if ($product->mrp)
                            <p style="text-decoration: line-through; float: left; margin-right: 10px;font-size: 21px; margin-top: 5px;">Tk {{ $product->mrp }}</p>
                          @endif
                          <b style="float: left; font-size: 30px; color: #ff6633; line-height: 1;">Tk {{ $product->sell_price }}</b>
                          {{-- <p style="font-size: 18px;margin-top: 5px;">(5% OFF)</p> --}}
                        </span>
                        <p>{!! $product->small_description !!}</p>
                        <form method="POST" action="{{ route('cart.store') }}">
                          @csrf
                        <div class="qty-input mb-3">
                            <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                            <input class="product-qty" type="number"  name="product_qty" min="0" max="1000" value="1">
                            <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if ($product->qty < 15)
                          <div class="note"><b>Hurry! Less Then 15</b> left in stock.</div>
                        @endif
                        <div class="btn-area">
                            <button class="cart_btn" type="submit" >ADD TO CART</button>
                            {{-- <button class="cart_wish"><i class="far fa-heart"></i> Add To Wishlist</button> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="wrapper">
                <div class="tabs">
                  <input hidden type="radio" name="tab-css" id="tab-1" checked />
                  <label class="tab-control" for="tab-1">Details</label>
                  @if ($product->vedio)
                    <input hidden type="radio" name="tab-css" id="tab-2" />
                    <label class="tab-control" for="tab-2">Video</label>
                  @endif
                  <input hidden type="radio" name="tab-css" id="tab-3" />
                  <label class="tab-control" for="tab-3">Write Reviwe</label>
              
                  <div class="tab-content">
                    <div id="tab-panel-1" class="tab-panel">
                      <p>{!! $product->long_description !!}</p>
                    </div>
                    @if ($product->vedio)
                      <div id="tab-panel-2" class="tab-panel">
                        <div class="o-video">
                          <iframe src="{{ $product->vedio }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                      </div>
                    @endif
                    <div id="tab-panel-3" class="tab-panel">
                      <div class="comments-area">
                        @foreach ($reviews as $review)
                          <div class="single-comments">
                            <img src="{{ asset('storage') }}/{{ $review->order->customer->profile_img }}" alt="">
                            <div class="star">
                              @for ($i = 1; $i <= $review['stars']; $i++)
                                <i class="fas fa-star"></i>
                              @endfor
                            </div>
                            <div class="text">
                              <h5>{{ $review->order->customer->name }}<span>{{ \Carbon\Carbon::parse($review->review_date)->diffForHumans() }}</span></h5>
                              <p>{{ $review->review }}</p>
                            </div>
                          </div>
                        @endforeach
                      </div>
                      @auth
                        @if ( $orders == 1 &&  $product_id == 1)
                          <div class="leave-comment">
                            <form id="contactForm" method="POST" action="{{ route('product.review') }}">
                              @csrf
                              <input type="hidden" value="{{ $orderdetails_id->id }}" name="orderdetail_id">
                              <div class="row"> 
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group wow fadeInUp">
                                      <label>Add A Reviwe</label>
                                      <ul>
                                        <li>
                                          <div class="head">
                                            Tesk
                                          </div>
                                          <div class="text" style="padding: 18px 0px 15px;">
                                            How Many Stars?
                                          </div>
                                        </li>
                                        <li>
                                          <div class="head">
                                            1 Star
                                          </div>
                                          <div class="text">
                                            <div class="radios">
                                              <input type="radio" value='1' name='stars' id='radio1'/>
                                              <label for='radio1'><i class="fas fa-star"></i></label>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="head">
                                            2 Star
                                          </div>
                                          <div class="text">
                                            <div class="radios">
                                              <input type="radio" value='2' name='stars' id='radio2'/>
                                              <label for='radio2'><i class="fas fa-star"></i></label>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="head">
                                            3 Star
                                          </div>
                                          <div class="text">
                                            <div class="radios">
                                              <input type="radio" value='3' name='stars' id='radio3'/>
                                              <label for='radio3'><i class="fas fa-star"></i></label>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="head">
                                            4 Star
                                          </div>
                                          <div class="text">
                                            <div class="radios">
                                              <input type="radio" value='4' name='stars' id='radio4'/>
                                              <label for='radio4'><i class="fas fa-star"></i></label>
                                            </div>
                                          </div>
                                        </li>
                                        <li>
                                          <div class="head">
                                            5 Star
                                          </div>
                                          <div class="text">
                                            <div class="radios">
                                              <input type="radio" value='5' name='stars' id='radio5'/>
                                              <label for='radio5'><i class="fas fa-star"></i></label>
                                            </div>
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                  <div class="form-group wow fadeInUp">
                                    <label>Your Reviwe</label>
                                      <textarea class="form-controls" required data-error="Write your message" rows="5" name="review"></textarea>
                                      <div class="help-block with-errors"></div>
                                  </div>
                                </div>
                                <div class="contact-btn wow fadeInUp">
                                  <button type="submit" class="main-btn">Post Comments</button>
                                  <div id="msgSubmit" class="h3 text-left hidden"></div>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </form>
                          </div>
                        @endif
                      @endauth
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Product HTML End -->

    <!-- Related Product HTML Start -->
    <section class="recent-product">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="row">
              @forelse ($releted_product as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
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
                                <input class="product-qty" type="number" name="product_qty" min="0" max="10" value="1">
                                <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                              </div>
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="submit">ADD TO CART</button>
                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="text">
                          <a href="{{ $product->slug }}">{{ $product->name }}</a>
                          <ul>
                            @if ($product->mrp)
                              <li style="text-decoration: line-through; color: #000033;">Tk {{ $product->mrp }}</li>
                            @endif
                            <li style="color: #ff6633;">Tk {{ $product->sell_price }}</li>
                          </ul>
                        </div>
                    </div>
                </div>
              @empty 
                <h4 class="text-center text-danger">No Releted Product Abailavle</h4>
              @endforelse
            </div>
            <nav aria-label="Page navigation example" style="padding: 30px 0 50px;">
              {{ $releted_product->links('frontend.pagination') }}
            </nav>
        </div>
    </section>
    <!-- Related Product HTML End -->

    @include('layouts.footer_app')
    
@endsection

@section('script_content')
  {{-- <script>
    $(document).ready(function(){
        $("#add_cart_btn").click(function(){
            let product_id = document.getElementById("product_id").value;
            let product_qty = document.getElementById("product_qty").value;
            let product_price = document.getElementById("product_price").value;
            let total_price = product_qty * product_price;

            // ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type :'POST',
                url : '/add/cart/list',
                data : {
                    product_id:product_id,
                    product_qty:product_qty,
                    product_price:product_price,
                },
                success : function (data) {
                  document.getElementById("cart_count").innerText = data;
                    // console.log(data);
                }
            });
        });
    });
  </script> --}}
@endsection