<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from neconvalves.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Oct 2025 05:31:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{ asset('front_assets/assets/images/favicon.png') }}">
    <title>Shreenath Engineering</title>

    <link href="{{ asset('front_assets/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/assets/sass/style.css') }}" rel="stylesheet">


</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="front_assets/assets/images/logo.png" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->
        <!-- Start header -->
        <!-- Start header -->


        <header id="header">
            <div class="topbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-lg-7 col-md-12 col-sm-12 col-12 ">
                            <div class="contact-intro">
                                <ul>
                                    <li><i class="fi flaticon-email"></i><a
                                            href="mailto:info@neconvalves.com">info@neconvalves.com</a> </li>
                                    <li><i class="fi flaticon-phone-call"></i><a href="tel:+91 9825530462"> +91 98255
                                            30462 </a> </li>
                                    <li><a href="https://maps.app.goo.gl/N2eVLQTV88TXRdq68"><i
                                                class="fi flaticon-placeholder"></i>
                                            Plot No. : B/22, Zaveri Estate, </a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <div class="translater">
                                <div id="google_translate_element"></div>
                            </div>

                        </div>
                        <div class="col col-lg-2 col-md-12 col-sm-12 col-12">
                            <div class="contact-info">
                                <ul>

                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                    <li><a href="#"><i class="ti-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end topbar -->
            <div class="wpo-site-header wpo-site-header-s3">
                <nav class="navigation navbar navbar-expand-lg navbar-light original">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
                                <div class="mobail-menu">
                                    <button type="button" class="navbar-toggler open-btn">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar first-angle"></span>
                                        <span class="icon-bar middle-angle"></span>
                                        <span class="icon-bar last-angle"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="index-2.html"><img
                                            src="front_assets/assets/images/logo.png" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-1 col-1 nav-responsive">
                                <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                    <button class="menu-close"><i class="ti-close"></i></button>
                                    <ul class="nav navbar-nav mb-2 mb-lg-0">
                                        <li>
                                            <a class="active" href="{{ route('homeWebsite') }}">Home</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('aboutWebsite') }}">About Us</a>
                                            <ul class="sub-menu">
                                                @foreach ($about_us_data as $section)
                                                    <li>
                                                        <a href="{{ route('aboutWebsiteById', $section->id) }}">
                                                            {{ $section->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>


                                        <li>
                                            <a href="{{ route('websiteCategoryList') }}">Products</a>

                                        </li>

                                        <li class="menu-item-has-children">
                                            <a href="{{ route('qualityWebsite') }}">Mfg.Process</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ route('qualityWebsite') }}">Quality</a></li>
                                            </ul>
                                        </li>


                                        {{-- <li>
                                            <a href="engineering-data.html">Engineering Data</a>
                                        </li>

                                        <li>
                                            <a href="media.html">Media</a>

                                        </li> --}}

                                        <li><a href="{{ route('contactWebsite') }}">Contact Us</a></li>

                                        <div class="header-right">
                                            <div class="close-form">
                                                <a class="theme-btn" href="{{ route('contactWebsite') }}">Get In
                                                    Touch</a>
                                            </div>
                                        </div>
                                    </ul>

                                </div><!-- end of nav-collapse -->
                            </div>
                            <!-- <div class="col-lg-2 col-md-2 col-2 btn-header-responsive">
                                <div class="header-right">

                                    <div class="close-form">
                                        <a class="theme-btn" href="contact-us.php">Get In Touch</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </nav>
                <nav class="navigation navbar navbar-expand-lg navbar-light sticky-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
                                <div class="mobail-menu">
                                    <button type="button" class="navbar-toggler open-btn">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar first-angle"></span>
                                        <span class="icon-bar middle-angle"></span>
                                        <span class="icon-bar last-angle"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="index-2.html"><img
                                            src="front_assets/assets/images/logo.png" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-1 col-1">
                                <div id="navbar" class="collapse navbar-collapse navigation-holder">
                                    <button class="menu-close"><i class="ti-close"></i></button>
                                    <ul class="nav navbar-nav mb-2 mb-lg-0">
                                        <li>
                                            <a class="active" href="index-2.html">Home</a>

                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="about-us.html">About Us</a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Company Profile </a></li>
                                                <li><a href="#">Vision & Mission</a></li>
                                                <li><a href="#"> Why Us</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="products.html">Products</a>

                                        </li>


                                        <li class="menu-item-has-children">
                                            <a href="#">Mfg.Process</a>
                                            <ul class="sub-menu">
                                                <li><a href="quality.html">Quality</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="engineering-data.html">Engineering Data</a>
                                        </li>
                                        <li>
                                            <a href="media.html">Media</a>

                                        </li>

                                        <li><a href="contact-us.html">Contact Us</a></li>
                                        <div class="header-right">
                                            <div class="close-form">
                                                <a class="theme-btn" href="contact-us.html">Get In Touch</a>
                                            </div>
                                        </div>
                                    </ul>

                                </div><!-- end of nav-collapse -->
                            </div>
                            <!-- <div class="col-lg-2 col-md-2 col-2">
                                <div class="header-right">

                                    <div class="close-form">
                                        <a class="theme-btn" href="contact-us.php">Get In Touch</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div><!-- end of container -->
                </nav>
            </div>
        </header>

        <!-- <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>  -->
