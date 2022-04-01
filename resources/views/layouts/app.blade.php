<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BarakahMart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin') }}/{{ 'assets/images/logo_sm.png' }}">

        <!-- App fontawesome -->
        <link href="{{ asset('admin') }}/{{ 'assets/css/all.min.css' }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin') }}/{{ 'assets/css/fontawesome.min.css' }}" rel="stylesheet" type="text/css">

        <!--Toaster aleart CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">

        <!-- DataTables -->
        <link href="{{ asset('admin') }}/{{ 'plugins/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'plugins/datatables/buttons.bootstrap4.min.css' }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('admin') }}/{{ 'plugins/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet" type="text/css" />

        <!-- Multi Item Selection examples -->
        <link href="{{ asset('admin') }}/{{ 'plugins/datatables/select.bootstrap4.min.css' }}" rel="stylesheet" type="text/css" />

        <!-- Custom box css -->
        <link href="{{ asset('admin') }}/plugins/custombox/css/custombox.min.css" rel="stylesheet">

        <!-- Select2 css -->
        <link href="{{ asset('admin') }}/plugins/select2/css/select2.min.css" rel="stylesheet">

        <!-- form Uploads -->
        <link href="{{ asset('admin/plugins/fileuploads/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Jquery filer css -->
        <link href="{{ asset('admin/plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}" rel="stylesheet" type="text/css" />
        
        <!-- Bootstrap fileupload css -->
        <link href="{{ asset('admin/plugins/bootstrap-fileupload/bootstrap-fileupload.css') }}" rel="stylesheet" type="text/css" />

        <!-- ckeditor js -->
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        
        <!-- App css -->
        <link href="{{ asset('admin') }}/{{ 'assets/css/bootstrap.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/icons.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/metismenu.min.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/style.css' }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin') }}/{{ 'assets/css/responsive.css' }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('admin') }}/{{ 'assets/js/modernizr.min.js' }}"></script>

    </head>


    <body>
        <!-- Messenger Chat plugin Code -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v10.0'
            });
            };

            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- Your Chat plugin code -->
        <div class="fb-customerchat"
            attribution="page_inbox"
            page_id="478060399647758">
        </div>
        <!-- Messenger Chat plugin Code End-->

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left" style="background: #fff">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="{{ asset('admin/assets/images/PNG.png') }}" alt="BarakahMart" width="220px" height="70px">
                        </span>
                        <i>
                            <img src="{{ asset('admin/assets/images/logo_sm.png') }}" alt="BarakahMart">
                        </i>
                    </a>
                </div>
                <nav class="navbar-custom">
                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">{{ neworder_count() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>New Order</h5>
                                </div>
                                @foreach (neworder() as $item)
                                    <!-- item-->
                                    <a href="{{ route('orderdetails',$item->id) }}" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                        <p class="notify-details">{{ $item->customer->name }}<small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></p>
                                    </a>
                                @endforeach

                            </div>
                        </li>
                        
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                @if(Auth::user()->profile_img == null)
                                    <img src="{{ asset('admin/assets/images/avatar.jpg') }}" alt="user-img" class="rounded-circle img-thumbnail img-responsive">
                                @else
                                    <img src="{{ asset('storage/public/'.Auth::user()->profile_img) }}" alt="user-img" class="rounded-circle" width="100px" height="100px">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! {{ Auth::user()->name }}</small> </h5>
                                </div>
                                <!-- item-->
                                <a href="{{ route('dashboard.profile') }}" class="dropdown-item notify-item">
                                    <i class="mdi mdi-settings"></i> <span>Profile</span>
                                </a>
                                <a class="dropdown-item notify-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" style="border: none;background: none;margin-left: -6px;"><i class="mdi mdi-power"></i><span>Logout</span></button>
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Top Bar End -->
                <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            @if (!Auth::user()->type == 0)
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <i class="fi-air-play"></i><span> Dashboard </span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->type == 0)
                                <li>
                                    <a href="{{ route('customer.order.view',Auth::id()) }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>My Order</span> </a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.invoice',Auth::id()) }}">
                                        <i class="fi-air-play"></i><span> Invoice </span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->type == 1)
                                <li>
                                    <a href="javascript: void(0);"><i class="fi-target"></i><span> Web Manage </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded=false>
                                        {{-- main slider  --}}
                                        <li>
                                            <a href="{{ route('slider.index') }}">
                                                <i class="fi-air-play"></i><span> Main Slider </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('offer.index') }}">
                                                <i class="fi-air-play"></i><span> Offer </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('setting.index') }}">
                                                <i class="fi-air-play"></i><span> Setting </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);"><i class="fi-target"></i><span> Admin Manage </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded=false>
                                        {{-- Admin  --}}
                                        <li>
                                            <a href="{{ route('admin.list') }}">
                                                <i class="fi-air-play"></i><span> Admin </span>
                                            </a>
                                        </li>
                                        {{-- Shop Category  --}}
                                        <li>
                                            <a href="{{ route('shop.category') }}">
                                                <i class="fi-air-play"></i><span> Shop Category </span>
                                            </a>
                                        </li>
                                        {{-- SubCategory  --}}
                                        <li>
                                            <a href="{{ route('subcategory.index') }}">
                                                <i class="fi-air-play"></i><span> SubCategory </span>
                                            </a>
                                        </li>
                                        {{-- City  --}}
                                        <li>
                                            <a href="{{ route('city.index') }}">
                                                <i class="fi-air-play"></i><span> City </span>
                                            </a>
                                        </li>
                                        {{-- Area --}}
                                        <li>
                                            <a href="{{ route('area.index') }}">
                                                <i class="fi-air-play"></i><span> Area </span>
                                            </a>
                                        </li>
                                        {{-- Brand --}}
                                        <li>
                                            <a href="{{ route('brand.index') }}">
                                                <i class="fi-air-play"></i><span> Brand </span>
                                            </a>
                                        </li>
                                        {{-- Unit --}}
                                        <li>
                                            <a href="{{ route('unit.index') }}">
                                                <i class="fi-air-play"></i><span> Unit </span>
                                            </a>
                                        </li>
                                        {{-- Product  --}}
                                        <li>
                                            <a href="{{ route('product.index') }}">
                                                <i class="fi-air-play"></i><span class="badge badge-danger pull-right">{{ product_alert() }}</span><span> Product </span>
                                            </a>
                                        </li>
                                        {{-- Invioce  --}}
                                        <li>
                                            <a href="{{ route('invoice.index') }}">
                                                <i class="fi-air-play"></i><span> Invoice </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('invoiceview') }}">
                                                <i class="fi-air-play"></i><span>Vendor Invoice </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->type == 2 || Auth::user()->type == 1)
                            <li>
                                <a href="{{ route('pos') }}">
                                    <i class="fi-air-play"></i><span> POS </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('purchase') }}">
                                    <i class="fi-air-play"></i><span> Purchase </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.list') }}">
                                    <i class="fi-air-play"></i><span> Customer </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('vendor.index') }}">
                                    <i class="fi-air-play"></i><span> Vendor </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('expence.index') }}">
                                    <i class="fi-air-play"></i><span> Cost </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-invert-colors"></i><span> Order </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('new.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>New Order</span> </a></li>
                                    <li><a href="{{ route('received.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Received Order</span> </a></li>
                                    <li><a href="{{ route('delevered.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Delevered Order</span> </a></li>
                                    <li><a href="{{ route('canceled.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Canceled Order</span> </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-invert-colors"></i><span>Report</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('customerdue',1) }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Customer Due</span> </a></li>
                                    <li><a href="{{ route('vendordue',2) }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Vendor Due</span> </a></li>
                                </ul>
                            </li>
                            @endif
                            @if(Auth::user()->type == 3)
                            <li>
                                <a href="{{ route('pos') }}">
                                    <i class="fi-air-play"></i><span> POS </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.list') }}">
                                    <i class="fi-air-play"></i><span> Customer </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('expence.index') }}">
                                    <i class="fi-air-play"></i><span> Cost </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-invert-colors"></i><span> Order </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('new.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>New Order</span> </a></li>
                                    <li><a href="{{ route('received.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Received Order</span> </a></li>
                                    <li><a href="{{ route('delevered.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Delevered Order</span> </a></li>
                                    <li><a href="{{ route('canceled.order') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Canceled Order</span> </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-invert-colors"></i><span>Report</span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{ route('customerdue') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Customer Due</span> </a></li>
                                    <li><a href="{{ route('vendordue') }}" class="waves-effect"><i class="mdi mdi-format-font"></i> <span>Vendor Due</span> </a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -left -->
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        @yield('content')

                    </div> <!-- container -->
                </div> <!-- content -->

                <footer class="footer text-right">
                    2021 © SyntexIT - Syntexit.com
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!--=== jQuery 3.6.0 ===-->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	    
        <!-- jQuery  -->
        <script src="{{ asset('admin') }}/{{ 'assets/js/popper.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/bootstrap.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/metisMenu.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/waves.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/custom.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.slimscroll.js' }}"></script>

        <!-- page specific js -->
        <script src="{{ asset('admin') }}/{{ 'assets/pages/jquery.fileuploads.init.js' }}"></script>

        <!-- Flot chart -->
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.time.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.tooltip.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.resize.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.pie.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.crosshair.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/curvedLines.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/flot-chart/jquery.flot.axislabels.js' }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('admin') }}/{{ 'plugins/datatables/jquery.dataTables.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/datatables/dataTables.bootstrap4.min.js' }}"></script>

        <!--toastr aleart Chart-->
		<script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
		<script src="{{ asset('admin/assets/js/toastr.js') }}"></script>

        <!-- Buttons examples -->
        <script src="{{ asset('admin') }}/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/jszip.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/pdfmake.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/vfs_fonts.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/buttons.html5.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/buttons.print.min.js"></script>

        <!-- Key Tables -->
        <script src="{{ asset('admin') }}/plugins/datatables/dataTables.keyTable.min.js"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('admin') }}/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- KNOB JS -->
        <script src="{{ asset('admin') }}/{{ 'plugins/jquery-knob/jquery.knob.js' }}"></script>

        <!-- Counter Up  -->
        <script src="{{ asset('admin') }}/{{ 'plugins/waypoints/lib/jquery.waypoints.min.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'plugins/counterup/jquery.counterup.min.js' }}"></script>
        
        <!-- Dashboard Init -->
        <script src="{{ asset('admin') }}/{{ 'assets/pages/jquery.dashboard.init.js' }}"></script>
        
        <!-- Jquery filer js -->
        <script src="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/js/jquery.filer.min.js"></script>
        
        
        <!-- Bootstrap fileupload js -->
        <script src="{{ asset('admin') }}/{{ 'plugins/bootstrap-fileupload/bootstrap-fileupload.js' }}"></script>
        

        <!-- Modal-Effect -->
        <script src="{{ asset('admin') }}/plugins/custombox/js/custombox.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/custombox/js/legacy.min.js"></script>

        <!-- Select2 Js -->
        <script src="{{ asset('admin') }}/plugins/select2/js/select2.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/select2/js/select2.full.min.js"></script>

        {{-- Date picker  --}}
        <script src="{{ asset('admin') }}/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('admin') }}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('admin') }}/assets/pages/jquery.form-pickers.init.js"></script>

        <!-- App js -->
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.core.js' }}"></script>
        <script src="{{ asset('admin') }}/{{ 'assets/js/jquery.app.js' }}"></script>
        <!-- handlebars.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                
                //Without Buttons
                var table = $('#datatable-button').DataTable({
                    lengthChange: false,
                    // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    buttons: false,
                });
                //Buttons 
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    buttons: ['copy', 'excel', 'pdf']
                });
                // Key Tables
                $('#key-table').DataTable({
                    keys: true
                });
                // Responsive Datatable
                $('#responsive-datatable').DataTable();
                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });
                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );
        </script>

        <!-- file uploads js -->
        <script src="{{ asset('admin/plugins/fileuploads/js/dropify.min.js') }}"></script>

        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop Your Picture',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>

        <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="{{ asset('admin') }}/plugins/parsleyjs/dist/parsley.min.js"></script>

        @yield('content.script')

    </body>
</html>