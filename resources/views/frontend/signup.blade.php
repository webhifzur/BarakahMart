@extends('layouts.frontend_app')
@section('frontend_content')
@include('layouts.sidebar_responsive_app')

    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Signup</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li>Signup</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <!-- Signup Area HTML Start -->
    <section class="login-area" style="padding: 50px 0;">
        <div class="container">
          <div class="login-from-area">
            <div class="title">
                <i class="fas fa-user"></i>
                <h2>Signup</h2>
            </div>
            <form id="contactForm" class="form-horizontal" method="POST" action="{{ route('customer.register') }}">
              @csrf
                <div class="row"> 
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group wow fadeInUp">
                            <label>Full Name</label>
                            <input type="text" class="form-control" required placeholder="Please enter your full neme" name="name" value="{{ old('name') }}">
                            @error('name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group wow fadeInUp">
                            <label>Phone</label>
                            <input type="text" class="form-control" required placeholder="Please enter your Phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group wow fadeInUp">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Please enter your Email" name="email" value="{{ old('email') }}">
                            @error('email')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row m-b-20">
                      <div class="col-6">
                          <label>City</label>
                          <select name="city" id="city" class="form-control">
                              @foreach (cities() as $city)
                                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                              @endforeach
                          </select>
                          @error('city')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="col-6">
                          <label>Area</label>
                          <select name="area" id="area" class="form-control">
                              @foreach (areas() as $area)
                                  <option value="{{ $area->id }}">{{ $area->name }}</option>
                              @endforeach
                          </select>
                          @error('area')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6"> 
                        <div class="form-group wow fadeInUp">
                            <label>Password</label>
                            <input id="pass1" class="form-control" type="password" name="password" placeholder="password" autocomplete="new-password">
                            @error('password')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6"> 
                        <div class="form-group wow fadeInUp">
                            <label>Re-Password</label>
                            <input data-parsley-equalto="#pass1" class="form-control" type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password">
                            @error('password_confirmation')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="contact-btn wow fadeInUp">
                    <button type="submit" class="main-btn">Submit</button>
                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="create text-center my-3">
                  <p>Already Registered ? <a href="{{ route('loginpage') }}">Login</a></p>
                </div>
            </form>
        </div>
        </div>
    </section>
    <!-- Signup Area HTML End -->

 @include('layouts.footer_app')
@endsection
@section('script_content')
    {{-- toastr js --}}
    <script>
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection