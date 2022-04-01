<!DOCTYPE html>
<html>
     <head>
        <meta charset="utf-8" />
        <title>SyntexIT</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin') }}/{{ 'assets/images/favicon.ico' }}">

        <!-- App css -->
        <link href="{{ asset('admin') }}/{{ 'assets/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/icons.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/metismenu.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/style.css' }}" rel="stylesheet" type="text/css" />

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
                                    <div class="text-center account-logo-box">
                                        <h2 class="text-uppercase">
                                            <a href="index.html" class="text-success">
                                                <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="account-content">
                                        <div class="text-center m-b-20">
                                            <p class="text-muted m-b-0">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                                        </div>
                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif

                                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                            @csrf
                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    <label>Email address</label>
                                                    <input class="form-control" type="email" placeholder="Enter Your Email" name="email" required>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Reset Password</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
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

                <div class="m-t-40 text-center">
                    <p class="account-copyright">2021 © SyntexIT - Syntexit.com</p>
                </div>

            </div>


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

    </body>
</html>