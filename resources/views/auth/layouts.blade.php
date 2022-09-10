<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>UMURINZI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <style>
        .card-body {
            max-height: 90vh;
            overflow: auto;
        }
        ::-webkit-scrollbar {
            width: 0.4375rem;
            border: 0.0625rem solid transparent;
        }
    
        ::-webkit-scrollbar-thumb {
            background: gray; 
            border-radius: 3.125rem;
        }
    </style>

   <body>
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0 align-items-center">
                    <!--Form-->
                    @yield('content')
                    <!--END FORM-->
                                <!-- end col -->
                        <div class="col-xxl-8 col-lg-8 col-md-6">
                            <div class="auth-bg bg-white py-md-5 p-4 d-flex">
                                <div class="bg-overlay bg-white"></div>
                                <!-- end bubble effect -->
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-xl-8">
                                        <div class="mt-4">
                                            <img src="/assets/images/login-img.png" class="img-fluid" alt="lala">
                                        </div>
                                        <div class="p-0 p-sm-4 px-xl-0 py-5">
                                            <div id="reviewcarouselIndicators" class="carousel slide auth-carousel" data-bs-ride="carousel">
                                                <div class="carousel-indicators carousel-indicators-rounded">
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>
                                            
                                                <!-- end carouselIndicators -->
                                                <div class="carousel-inner w-75 mx-auto">
                                                    <div class="carousel-item active">
                                                        <div class="testi-contain text-center">
                                                            <h5 class="font-size-20 mt-4">“Umurinzi”
                                                            </h5>
                                                            <p class="font-size-15 text-muted mt-3 mb-0">Description 1</p>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="testi-contain text-center">
                                                            <h5 class="font-size-20 mt-4">“Umurinzi”</h5>
                                                            <p class="font-size-15 text-muted mt-3 mb-0">
                                                                Description 2
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="testi-contain text-center">
                                                            <h5 class="font-size-20 mt-4">“Umurinzi”</h5>
                                                            <p class="font-size-15 text-muted mt-3 mb-0">
                                                        Description 3
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel-inner -->
                                            </div>
                                            <!-- end review carousel -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                </div>
            </div>
        </div>

        
        <!-- JAVASCRIPT -->
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/eva-icons/eva.min.js"></script>

        <script src="/assets/js/pages/pass-addon.init.js"></script>

       <script src="/assets/js/pages/eva-icon.init.js"></script>


       <script src="/assets/js/app.js"></script>
    </body>

<!-- Mirrored from themesbrand.com/borex/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Sep 2022 09:27:58 GMT -->
</html>