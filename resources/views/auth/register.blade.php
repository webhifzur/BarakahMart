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

        <!-- Select2 css -->
        <link href="{{ asset('admin') }}/plugins/select2/css/select2.min.css" rel="stylesheet">

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
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <img class="img-fluid" src="{{ asset('admin/assets/images/login.png') }}" alt="BarakahMart">
                                            </a>
                                        </h2>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Register</h5>
                                        <p class="m-b-0">Get access to our admin panel</p>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Full Name</label>
                                                    <input class="form-control" type="text" placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Phone</label>
                                                    <input class="form-control" type="text" placeholder="Enter Your Phone" name="phone" value="{{ old('phone') }}">
                                                </div>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Email address</label>
                                                    <input class="form-control" type="email" placeholder="Enter Email address" name="email" value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="address" placeholder="House:01,road:01,Block:F,">{{ old('address') }}</textarea>
                                                </div>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Password</label>
                                                    <input id="pass1" class="form-control" type="password" name="password" placeholder="Enter your password" autocomplete="new-password">
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Confirm Password</label>
                                                    <input data-parsley-equalto="#pass1" class="form-control" type="password" name="password_confirmation" placeholder="Enter your Confirm password" autocomplete="new-password">
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up Free</button>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- <div class="row">
                                            <div class="col-12">
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
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Already have an account?  <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                        </div>
                        <!-- end wrapper -->
                    </div>
                </div>
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

        <!--toastr aleart Chart-->
		<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
		<script src="{{ asset('admin/assets/js/toastr.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.core.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.app.js' }}"></script>

        <!-- Select2 Js -->
        <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>

        <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="{{ asset('admin') }}/plugins/parsleyjs/dist/parsley.min.js"></script>

        <script>
            //select2 js
            $(document).ready(function() {
                $('#city').select2();
                $('#area').select2();
                $('form').parsley();
            });
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