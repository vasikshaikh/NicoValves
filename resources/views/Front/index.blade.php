@extends('Front.Layout.main')

@section('main-container')
    {{-- <section class="wpo-hero-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-inner slide-bg-image"
                        data-background="{{ asset('front_assets/assets/images/slider/banner-1.jpg') }}">
                        <!-- <div class="gradient-overlay"></div> -->
                        <div class="container-fluid">
                            <div class="slide-content">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>Welcome To <img src="{{ asset('front_assets/assets/images/logo.png') }}"
                                            alt=""> Valves</h2>
                                    <h3><span>One Of The Biggest Manufacturers & Exporters Of Industrial Valves </span>
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end slide-inner -->
                </div> <!-- end swiper-slide -->
                <div class="swiper-slide">
                    <div class="slide-inner slide-bg-image"
                        data-background="{{ asset('front_assets/assets/images/slider/banner-2.jpg') }}">
                        <!-- <div class="gradient-overlay"></div> -->
                        <div class="container-fluid">
                            <div class="slide-content">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>Better Flow, <br> Great Productivity</h2>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end slide-inner -->
                </div>
                <!-- end swiper-slide -->
                <div class="swiper-slide">
                    <div class="slide-inner slide-bg-image"
                        data-background="{{ asset('front_assets/assets/images/slider/banner-3.jpg') }}">
                        <!-- <div class="gradient-overlay"></div> -->
                        <div class="container-fluid">
                            <div class="slide-content">
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>Our Precision, <br>Your Advantage !</h2>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end slide-inner -->
                </div>
                <!-- end swiper-slide -->
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section> --}}

    <section class="wpo-hero-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($slider_data as $slider)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-bg-image"
                            data-background="{{ asset('SliderImage/' . $slider->slider_image) }}">
                            <!-- <div class="gradient-overlay"></div> -->
                            <div class="container-fluid">
                                <div class="slide-content">
                                    <div data-swiper-parallax="300" class="slide-title">
                                        <h2>{{ $slider->title }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end slide-inner -->
                    </div> <!-- end swiper-slide -->
                @endforeach
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>


    <div class="selogan">
        <div class="container">
            <div class="title">
                <h2>Manufacturers & exporters of industrial valves & valve Automation</h2>
            </div>
        </div>
    </div>




    {{-- <section class="wpo-about-section-s3 section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-12">
                    <div class="content">
                        <div class="text">
                            <h2>About Company</h2>
                            <h3>{{ $about_data->title }}</h3>

                            <p>{!! $about_data->description !!}</p>

                            <div class="icon">
                                <img src="{{ asset('AboutImage/' . $about_data->image) }}" alt="">
                            </div>
                        </div>

                        <div class="about-btn">
                            <a href="{{ route('aboutWebsite') }}" class="theme-btn">About Us</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 col-12">
                    <div class="about-title">
                        <h3>Why NECON Valves?</h3>
                    </div>


                    <div class="row">
                        @foreach ($goal_data as $goal)
                            <div class="col-md-6 about-box">
                                <div class="inner">
                                    <div class="icon">
                                        <img src="{{ asset('GoalImage/' . $goal->image) }}" alt="">
                                    </div>
                                    <h4>{{ $goal->title }}</h4>
                                    <p>{{ $goal->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </section> --}}

<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // animation duration
    once: true,     // animation only once
    easing: 'ease-in-out',
  });
</script>

<section class="wpo-about-section-s3 section-padding" style="padding: 80px 0; background: #f9fafc;">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Side: About Company -->
            <div class="col-lg-6 col-12" data-aos="fade-right">
                <div class="content">
                    <div class="text">
                        <h2 style="font-size: 32px; font-weight: 700; color: #222; margin-bottom: 10px;">About Company</h2>
                        <h3 style="font-size: 24px; font-weight: 600; color: #003c95; margin-bottom: 20px;">
                            {{ $about_data->title }}
                        </h3>

                        <p style="color: #555; line-height: 1.8; font-size: 16px;">
                            {!! $about_data->description !!}
                        </p>

                        <div class="icon" style="margin-top: 25px; overflow: hidden; border-radius: 10px;">
                            <img src="{{ asset('AboutImage/' . $about_data->image) }}" alt=""
                                 style="width: 100%; max-width: 450px; object-fit: cover; transition: transform 0.5s;"
                                 class="about-img">
                        </div>
                    </div>

                    <div class="about-btn" style="margin-top: 25px;">
                        <a href="{{ route('aboutWebsite') }}"
                           style="display: inline-block; background: #003c95; color: #fff; padding: 12px 25px; border-radius: 8px;
                                  text-decoration: none; font-weight: 600; transition: all 0.3s;"
                           class="btn-hover">
                            About Us
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Why NECON Valves -->
            <div class="col-lg-6 col-12" style="margin-top: 30px;">
                <div class="about-title" data-aos="fade-left" style="margin-bottom: 30px;">
                    <h3 style="font-size: 26px; font-weight: 700; color: #222;">Why NECON Valves?</h3>
                </div>

                <div class="row">
                    @foreach ($goal_data as $goal)
                        <div class="col-md-6 about-box" style="margin-bottom: 25px;" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 200 }}">
                            <div class="inner"
                                 style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.05);
                                        text-align: center; transition: transform 0.5s, box-shadow 0.5s;">
                                <div class="icon" style="margin-bottom: 15px;">
                                    <img src="{{ asset('GoalImage/' . $goal->image) }}" alt=""
                                         style="width: 70px; height: 70px; object-fit: contain; transition: transform 0.5s;"
                                         class="goal-img">
                                </div>
                                <h4 style="font-size: 18px; font-weight: 600; color: #003c95; margin-bottom: 10px;">
                                    {{ $goal->title }}
                                </h4>
                                <p style="font-size: 15px; color: #555; line-height: 1.6;">
                                    {{ $goal->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Hover effect for About image */
        .about-img:hover {
            transform: scale(1.05);
        }

        /* Hover effect for goal images */
        .goal-img:hover {
            transform: scale(1.1);
        }

        /* Hover effect for button */
        .btn-hover:hover {
            background: #0056b3;
            transform: translateY(-3px);
        }

        /* Hover effect for goal cards */
        .about-box .inner:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
    </style>
</section>


<section class="wpo-service-section-s2 section-padding">
    <div class="container">
        {{-- Section Title --}}
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="wpo-section-title-s2">
                    <h2>Our Featured Products</h2>
                </div>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="row">
            @forelse ($product_data as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    {{-- 1. Improved Product Card --}}
                    <div class="product-card">
                        <a href="{{-- route('productDetails', $product->id) --}}" class="product-image-link">
                            <div class="product-image">
                                @php
                                    // Cleaner logic for getting the first image
                                    $first_image = 'default-product.png'; // Default image
                                    if (!empty($product->image)) {
                                        $images = json_decode($product->image);
                                        if (is_array($images) && !empty($images)) {
                                            $first_image = $images[0];
                                        }
                                    }
                                @endphp
                                <img src="{{ asset('productImage/' . $first_image) }}" alt="{{ $product->title }}">
                            </div>
                        </a>
                        <div class="product-content">
                            <h3 class="product-title">{{ $product->title }}</h3>

                            {{-- 2. Improved PDF Download Button --}}
                            @if ($product->document)
                                <a href="{{ asset('ProductDocuments/' . $product->document) }}" target="_blank" class="pdf-download-btn">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Download PDF</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No products found.</p>
                </div>
            @endforelse
        </div>

        {{-- "View More" button centered --}}
        <div class="text-center mt-4">
             <a href="{{ route('websiteCategoryList') }}" class="pdf-download-btn">View More Products</a>
        </div>
    </div>
</section>

{{-- Add this style block at the end of your file or move to your main CSS file --}}
<style>
    /* Section Title Styling */
    .wpo-section-title-s2 {
        text-align: center;
        margin-bottom: 50px;
    }
    .wpo-section-title-s2 h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
    }

    /* 1. New Product Card Styling */
    .product-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
  .product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e31e24;
}
    .product-image {
        height: 220px;
        overflow: hidden;
        background-color: #fdfdfd;
    }
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Use 'contain' to show full product, or 'cover' to fill space */
        transition: transform 0.4s ease;
    }
    .product-card:hover .product-image img {
        transform: scale(1.08);
    }
    .product-content {
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Allows content to fill space */
    }
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #343a40;
        margin-top: 0;
        margin-bottom: 15px;
        flex-grow: 1; /* Pushes the button to the bottom */
    }

    /* 2. New PDF Download Button Styling */
    .pdf-download-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px; /* Space between icon and text */
        padding: 8px 18px;
        background: linear-gradient(45deg, #0d6efd, #0056b3);
        color: #fff;
        border-radius: 50px; /* Pill shape */
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .pdf-download-btn i {
        font-size: 1.1em; /* Make icon slightly bigger than text */
    }
    .pdf-download-btn:hover {
        background: linear-gradient(45deg, #c82333, #a51825);
        transform: scale(1.05);
        color: #fff;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    /* General Theme Button for "View More" */

</style>





    {{-- <section class="why-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="sub-title">
                        <h2>why choose us</h2>
                        <div class="disc">
                            <p>We had made enormous investments for testing equipments and the inspection process. No valve
                                goes to the next stage of the production process without passing the inspection of each
                                process. We conduct a rigorous test of the quality and chemical composition of the raw
                                material. Dimensional and visual inspections are rigidly conducted on every component of the
                                assembly. Our valves are subjected to 100% pressure tests to guarantee users with full
                                satisfaction.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-1.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Quality conscious attitude</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-2.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Customer Centric Approach</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-3.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Innovative appetite</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-4.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Team Work</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-5.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Employee satisfaction oriented</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-6.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Transparency</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-7.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <h5>Truthfulness</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 why-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/img-8.png') }}" alt="">
                                </div>

                            </div>
                        </div>
    </section> --}}

    <section class="why-us">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Title & Description -->
            <div class="col-md-6">
                <div class="sub-title">
                    @if($choose_data->first())
                        <h2>{{ $choose_data->first()->title }}</h2>
                        <div class="disc">
                            <p>{!! $choose_data->first()->description !!}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Points -->
            <div class="col-md-6">
                <div class="row">
                    @if($choose_data->first())
                        @php
                            $points_titles = $choose_data->first()->points_title; // already an array
                            $points_images = $choose_data->first()->points_image; // already an array
                        @endphp

                        @foreach($points_titles as $index => $point)
                            <div class="col-md-6 why-box">
                                <div class="inner">
                                    <div class="icon">
                                        @php
                                            $img = $points_images[$index] ?? 'default-icon.png';
                                        @endphp
                                        <img src="{{ asset('chooseImage/' . $img) }}" alt="{{ $point }}">
                                    </div>
                                    <div class="text">
                                        <h5>{{ $point }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>



    {{-- <section class="wpo-feature-section-s3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('front_assets/assets/images/feature/2.png') }}" alt="">
                        </div>
                        <div class="content">
                            <h2><span class="odometer" data-count="25">00</span>+</h2>
                            <span>Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('front_assets/assets/images/feature/img-2.png') }}" alt="">
                        </div>
                        <div class="content">
                            <h2><span class="odometer" data-count="25">00</span>+</h2>
                            <span>Years Of Experience</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('front_assets/assets/images/feature/1.png') }}" alt="">
                        </div>
                        <div class="content">
                            <h2><span class="odometer" data-count="25000">00</span>+</h2>
                            <span>Capacity</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('front_assets/assets/images/feature/6.svg') }}" alt="">
                        </div>
                        <div class="content">
                            <h2><span class="odometer" data-count="600">00</span>+</h2>
                            <span>Happy Clients</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section> --}}

    <section class="wpo-feature-section-s3">
    <div class="container">
        <div class="row">
            @foreach($achievement_data as $achievement)
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="item">
                        <div class="icon">
                            <img src="{{ asset('AchievementImage/' . $achievement->image) }}" alt="{{ $achievement->title }}">
                        </div>
                        <div class="content">
                            <h2>
                                <span class="odometer" data-count="{{ $achievement->count }}">00</span>+
                            </h2>
                            <span>{{ $achievement->title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



    {{-- <section class="application">
        <div class="container">
            <div class="wpo-section-title-s2">
                <h3>Serve Our sectors</h3>
            </div>
            <div class="row application-main">
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-1.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Power Plants</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-2.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Pulp & Paper Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-3.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Fertilizer Plants</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-4.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Marine Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-5.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Sugar Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-6.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Pipe Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-7.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Cement Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-8.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Water Treatment Plants</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-9.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Chemical Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-10.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Pharma Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-11.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Oil and Gas Industries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 application-box">
                    <div class="inner">
                        <div class="image">
                            <img src="{{ asset('front_assets/assets/images/application/img-12.jpg') }}" alt="">
                        </div>
                        <div class="text">
                            <h4>Construction Industries</h4>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section> --}}
@endsection
