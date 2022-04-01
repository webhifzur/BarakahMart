<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- All CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.css') }}">
    <!-- carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

    <!--Toaster aleart CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsiver.css') }}">

    <title>BARAKAH MART</title>
  </head>
  <body>

    <!-- Top Bar HTML Start -->
    <div class="top-bar-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-md-12">
            <div class="logo-area">
              <a href="{{ url('/') }}"><img src="{{ asset('uploads/'.setting()->menu_logo) }}" alt="logo"></a>
            </div>
          </div>
          <div class="col-xl-5 col-lg-5 col-md-6">
            @auth
            <div class="dropdown user">
                  <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->profile_img == null)
                        <img src="{{ asset('admin/assets/images/avatar.jpg') }}" alt="user-img" title="Mat Helme" class="img-thumbnail img-responsive" width="30px">
                    @else
                        <img src="{{ asset('storage/public/'.Auth::user()->profile_img) }}" alt="user-img" class="rounded-circle" width="30px" height="30px">
                    @endif
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item">{{ Auth::user()->name }}</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li>
                      <form method="POST" action="{{ route('logout') }}" class="dropdown-item logout">
                        @csrf
                        <button type="submit">Logout</button>
                      </form>
                    </li>
                  </ul>
                </div>
              @else
                <div class="dropdown user">
                  <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('loginpage') }}">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('signuppage') }}">Creat a Account</a></li>
                  </ul>
                </div>
              @endauth

              <form>
                <i class="fas fa-search search"></i>
                <input id="shopSearching" class="form-control me-2" type="text" placeholder="Find Something...." >
              </form>
              <div id="searchField" class="searchFieldHide">
                <ul id="searchList"></ul>
              </div>
            </div>
          <div class="col-xl-5 col-lg-5 col-md-6">
            <div class="admin-area text-center">
              <ul>
                @auth
                   <li>
                    <div class="dropdown">
                      <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->profile_img == null)
                            <img src="{{ asset('admin/assets/images/avatar.jpg') }}" alt="user-img" title="Mat Helme" class="img-thumbnail img-responsive" width="30px">
                        @else
                            <img src="{{ asset('storage/public/'.Auth::user()->profile_img) }}" alt="user-img" class="rounded-circle" width="30px" height="30px">
                        @endif
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item">{{ Auth::user()->name }}</a></li>
                      <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                      <li>
                         <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                              @csrf
                              <button type="submit">Logout</button>
                          </form>
                      </li>
                    </ul>
                    </div>
                  </li>
                @else
                  <li>
                    <div class="dropdown">
                      <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('loginpage') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('signuppage') }}">Creat a Account</a></li>
                      </ul>
                    </div>
                  </li>
                @endauth
                <li class="icon phone"><a href="tel:{{ setting()->phone_one }}" class="text-decoration-none"><i class="fas fa-phone-alt"></i> {{ setting()->phone_one }}</a></li>
                <li class="icon"><a href="{{ setting()->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li class="icon"><a href="{{ setting()->whatsapp }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Top Bar HTML End -->

    <!-- Cart Btn HTML Start -->
    <div class="cart-btn">
      <a class="cart" href="{{ route('cartpage') }}">
        <i class="fas fa-shopping-cart"></i>
        <div>
          <span>{{ cart_count() }} {{ 'Item' }}</span>
        </div>
      </a>
      @php
        $sub_total = 0;
      @endphp
      <div class="price">৳
        @foreach(cart_items() as $cart_item)
            @php
                $sub_total = $sub_total + ($cart_item->product_qty * $cart_item->relationship_with_cart->sell_price)
            @endphp
        @endforeach
          {{ $sub_total }}
      </div>
    </div>
    <!-- Cart Btn HTML End -->

    @yield('frontend_content')

    <!-- All JS -->
    <script src="{{ asset('frontend/js/jquery-2.2.4.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/all.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.js') }}"></script>
    {{-- carousel --}}
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>

    {{-- zoom --}}
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>

    <!--toastr aleart Chart-->
		<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
		<script src="{{ asset('admin/assets/js/toastr.js') }}"></script>

     <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="{{ asset('admin') }}/plugins/parsleyjs/dist/parsley.min.js"></script>

    <script src="{{ asset('frontend/js/all.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
      // Start Searching javascript
      document.getElementById("shopSearching").addEventListener('keyup',function(e){
          let searchLengthValue=e.target.value;
          let searchLength=searchLengthValue.length;

          if(searchLength>0){
              document.getElementById("searchField").style.display = 'block';
              $.ajaxSetup({
                  headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                  }
              }),
              $.ajax({
                  type: "POST",
                  url: "/product/searching",
                  data: { searchValue: searchLengthValue },
                  success: function (data) {
                      let datas='';
                      for(let x of data){
                        datas+=`<li><a href="/single/product/${x.slug}"> ${x.name}</a></li>`;
                      }
                      console.log(datas);
                      document.getElementById("searchList").innerHTML = datas;
                  },
              });
            }
         else if(searchLength==0){
            document.getElementById("searchField").style.display = "none";
          }
      })
      // End Searching javascript
    </script>


    @yield('script_content')

  </body>
</html>