<!DOCTYPE html>
<html>
     <head>
        <meta charset="utf-8" />
        <title>BarakahMart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin') }}/{{ 'assets/images/logo_sm.png' }}">

        <!--Toaster aleart CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">

        <!-- App css -->
        <link href="{{ asset('admin') }}/{{ 'assets/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/icons.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/metismenu.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/style.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/responsive.css' }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('admin') }}/{{ 'assets/js/modernizr.min.js' }}"></script>
    </head>
    <body>
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box row">
                                <div class="account-logo-box col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="text-uppercase text-center">
                                        <a href="index.html" class="text-success">
                                            <img class="img-fluid" src="{{ asset('admin/assets/images/login.png') }}" alt="BarakahMart">
                                        </a>
                                    </h2>
                                    <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                    <p class="m-b-0">Login to your account</p>
                                </div>
                                <div class="account-content col-lg-12 col-md-12 col-sm-12 col-12">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group m-b-20 row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <label>Username</label>
                                                <input class="form-control" type="text" placeholder="Enter your Username/Phone" name="email">
                                            </div>
                                        </div>
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" placeholder="Enter your password" name="password">
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group row m-b-20">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    
                                                <div class="checkbox checkbox-custom">
                                                    <input id="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div>
    
                                            </div>
                                        </div>
    
                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                                                    <i class="fa fa-facebook"></i>
                                                </button>
                                                <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                                                    <i class="fa fa-google"></i>
                                                </button>
                                                <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                                                    <i class="fa fa-twitter"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row m-t-50">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <!-- end card-box-->
                </div>
                <!-- end wrapper -->
            </div>
        </section>
        <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/popper.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/bootstrap.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/metisMenu.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/waves.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.slimscroll.js' }}"></script>

        <!-- App js -->
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.core.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.app.js' }}"></script>
        <!--toastr aleart Chart-->
		<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
		<script src="{{ asset('admin/assets/js/toastr.js') }}"></script>
        <script>
            // toastr js
            @if(Session::has('success'))
                // Display a success toast, with a title
                toastr.success('Product Add Successfully', 'Congratulation!')
            @endif
            @if ($errors->any())
                // Display an error toast, with a title
                toastr.error('You Have Any Error', 'Sorry!')
            @endif
        </script>
    </body>
</html>