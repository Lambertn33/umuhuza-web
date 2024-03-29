<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/borex/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Sep 2022 09:25:59 GMT -->
<head>

        <meta charset="utf-8" />
        <title>UMURINZI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

                <!-- choices css -->
        <link href="/assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

        <!-- color picker css -->
        <link rel="stylesheet" href="/assets/libs/%40simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
        <link rel="stylesheet" href="/assets/libs/%40simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
        <link rel="stylesheet" href="/assets/libs/%40simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

        <!-- datepicker css -->
        <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <style>
        .logo-img {
            margin-top: 1.25rem;
            width: 90%;
        }
        table.datatable.no-footer {
            border: none;
        }
        table.datatable thead th, table.datatable thead td {
            
        }
        table.datatable thead th {
            font-weight: 600;
            border: none;
            font-size: 14px;
        }
        table.datatable tbody th{
            padding: 0.75rem 0.625rem;
            border: none;
        }
        table.datatable tbody td {
            padding: 1rem 0.625rem;
            border: none;
            font-size: 0.875rem
        }
        .dataTables_length select {
            padding: 0.1875rem;
            border-color: gray;
            border-radius: 0.375rem
        }
        .dataTables_info, .dataTables_paginate {
            margin-top: 0.5rem;
        }
        ::-webkit-scrollbar {
            width: 0.4375rem;
            border: 0.0625rem solid transparent;
        }
    
        ::-webkit-scrollbar-thumb {
            background: gray; 
            border-radius: 3.125rem;
        }
        #sidebar-menu ul li ul.sub-menu li a {
            color: #d9d9d9 !important;
        }
        #sidebar-menu ul li ul.sub-menu li a:hover {
            font-weight: 600;
            transition: .5s;
        }
    </style>

    
    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar" class="isvertical-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="#" class="logo logo-dark">
                               <h2>LOGO</h2>
                            </a>

                            <a href="#" class="logo logo-light">
                               <h2>LOGO</h2>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn topnav-hamburger">
                            <div class="hamburger-icon open">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>

                        <div class="d-none d-sm-block ms-3 align-self-center">
                            @yield('title')
                        </div>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm" data-eva="bell-outline"></i>
                                <span class="noti-dot bg-danger rounded-pill">4</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="m-0 font-size-15"> Notifications </h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small fw-semibold text-decoration-underline"> Mark all as read</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 250px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                        <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm" data-eva="person-outline"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end pt-0">
                                <div class="p-3 border-bottom">
                                    <h6 class="mb-0">{{Auth::user()->names}}</h6>
                                    <p class="mb-0 font-size-11 text-muted">{{Auth::user()->email}}</p>
                                </div>
                                <a class="dropdown-item" data-bs-toggle="offcanvas" href="#notaryProfile" role="button" aria-controls="notaryProfile"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('logoutForm').submit();"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>

                                <form action="{{route('logout')}}" method="POST" id="logoutForm" style="display: none">
                                  @csrf
                                </form>
                            </div>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="notaryProfile" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Profile</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="user-sidebar">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <div class="user-profile-img">
                                                            <div style="height: 120px;background-color:transparent">
                                                            </div>
                                                            <div class="overlay-content rounded-top">
                                                                <div>
                                                                    <div class="user-nav p-3">
                                                                        <div class="d-flex justify-content-end">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end user-profile-img -->
                        
                                                        <div class="mt-n5 position-relative">
                                                            <div class="text-center">
                                                                <img src="/assets/images/profile.png" alt=""
                                                                    class="" style="width: 100;border-radius:100%">
                                                                <div class="mt-3">
                                                                    <h5 class="mb-1">{{Auth::user()->names}}</h5>
                                                                    <p class="text-muted">{{Auth::user()->email}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                    
                                                    </div>
                                                    <!-- end card body -->
                                                </div>
                                                <!-- end card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <img src="/assets/images/umurinzi_logo.jpg" width="100%" alt="" class="logo-img">
                </div>

                <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger">
                    <div class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Dashboard</li>
                            <li>
                                <a href="{{route('getNotaryDashboardOverview')}}">
                                    <i class="icon nav-icon" data-eva="grid-outline"></i>
                                    <span class="menu-item" data-key="t-filemanager">System Overview</span>
                                </a>
                            </li>

                            <li class="menu-title" data-key="t-applications">Pages</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="icon nav-icon" data-eva="file-outline"></i>
                                    <span class="menu-item" data-key="t-ecommerce">My Files</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('myNotaryFiles')}}" data-key="t-products">Uploaded Files</a></li>
                                    <li><a href="{{route('myTaggedFiles')}}" data-key="t-products">Tagged Files</a></li>
                                    <li><a href="{{route('myFileAccessRequests')}}" data-key="t-products">Files Access Requests</a></li>
                                </ul>
                            </li>

                        </ul>
                        
                    </div>
                </div>
            </div>
            <!-- Left Sidebar End -->
            <header id="page-topbar" class="ishorizontal-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-dark-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-light-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="22">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <div class="d-none d-sm-block ms-2 align-self-center">
                            <h4 class="page-title">
                                @yield('title')
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="topnav">
                    <div class="container-fluid">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
    
                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                <ul class="navbar-nav">   
    
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
            
                        @yield('content')
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <script>document.write(new Date().getFullYear())</script> &copy;
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- chat offcanvas -->

        <!-- JAVASCRIPT -->
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/eva-icons/eva.min.js"></script>

        <!-- apexcharts -->
        <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
        
        <script src="/assets/js/pages/dashboard.init.js"></script>

        <script src="/assets/js/app.js"></script>

                <!-- choices js -->
        <script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

        <!-- color picker js -->
        <script src="/assets/libs/%40simonwep/pickr/pickr.min.js"></script>
        <script src="/assets/libs/%40simonwep/pickr/pickr.es5.min.js"></script>

        <!-- datepicker js -->
        <script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- init js -->
        <script src="/assets/js/pages/form-advanced.init.js"></script>

    </body>

</html>