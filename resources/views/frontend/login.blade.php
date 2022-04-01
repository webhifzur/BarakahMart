@extends('layouts.frontend_app')
@section('frontend_content')
@include('layouts.sidebar_responsive_app')

    <!-- Inner Banner HTML Start -->
    <div class="inner-banner" style="background-image: url({{ asset('uploads/'.setting()->innerpage) }})">
      <div class="container">
        <div class="text">
          <h1>Login</h1>
          <ul>
              <li><a href="{{ url('/') }}">Home</a></li>
              <li>></li>
              <li>Login</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Inner Banner HTML End -->
    
    <!-- Login Area HTML Start -->
    <section class="login-area" style="padding: 50px 0;">
        <div class="container">
            <div class="login-from-area">
                <div class="title">
                    <i class="fas fa-user"></i>
                    <h2>Login</h2>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row"> 
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group wow fadeInUp">
                                <label>Email/Username</label>
                                <input type="text" class="form-control" required data-error="Please enter your Email" name="email">
                                <div class="help-block with-errors"></div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12"> 
                            <div class="form-group wow fadeInUp">
                                <label>Password</label>
                                <input type="password" class="form-control" required data-error="Please enter your Password" name="password">
                                <div class="help-block with-errors"></div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Remember me
                                </label>
                            </div>
                        </div> --}}
                        <div class="col-md-6 col-sm-6 col-12"></div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="forget text-end">
                                <a href="{{ route('password.request') }}">Forget Password</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul>
                            <li>Account : </li>
                            <li>admin@gmail.com</li>
                        </ul>
                        <ul>
                            <li>pass : </li>
                            <li>password</li>
                        </ul>
                    </div>
                    <div class="contact-btn wow fadeInUp">
                        <button type="submit" class="main-btn">Login</button>
                        <div id="msgSubmit" class="h3 text-left hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="create text-center my-3">
                        <p>Not Registered Yet? <a href="{{ route('signuppage') }}">Create an Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Login Area HTML End -->
@include('layouts.footer_app')
@endsection
