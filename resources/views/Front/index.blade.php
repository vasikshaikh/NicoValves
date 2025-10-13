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

    <section class="wpo-about-section-s3 section-padding">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-12">
                    <div class="content">
                        <div class="text">
                            <h2>About Company</h2>
                            <h3>{{ $about_data->title }}</h3>

                            <p>{!! $about_data->description !!}</p> {{-- Correct unescaped syntax --}}

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
                    {{-- <div class="row">
                        <div class="col-md-6 about-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/about-1.png') }}" alt="">
                                </div>
                                <h4>Best Quality</h4>
                                <p>Our knowledge in the domain blended with the vast experience has enabled us to serve our
                                    customers with the best they need.</p>
                            </div>
                        </div>
                        <div class="col-md-6 about-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/about-2.png') }}" alt="">
                                </div>
                                <h4>Exact Price</h4>
                                <p>We aim to provide more then best in worth money Price.</p>
                            </div>
                        </div>
                        <div class="col-md-6 about-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/about-3.png') }}" alt="">
                                </div>
                                <h4>Engineering Excellence</h4>
                                <p>"To be the leading innovator in valve technology, setting industry standards for
                                    reliability, efficiency, and sustainability."</p>
                            </div>
                        </div>
                        <div class="col-md-6 about-box">
                            <div class="inner">
                                <div class="icon">
                                    <img src="{{ asset('front_assets/assets/images/icon/about-4.png') }}" alt="">
                                </div>
                                <h4>Global Presence</h4>
                                <p>"With a strong global footprint, we serve diverse industries worldwide, leveraging our
                                    international expertise to deliver."</p>
                            </div>
                        </div>
                    </div> --}}

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
    </section>




    <section class="wpo-service-section-s2 section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <div class="wpo-section-title-s2">

                        <h3>Our Products</h3>
                    </div>
                </div>
            </div>
            {{-- <div class="row">

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="service-card">
                        <a href="wafer-butterfly-valve.html">
                            <div class="image">
                                <img src="{{ asset('front_assets/assets/images/products/img-66.png') }}" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="wafer-butterfly-valve.html">Wafer Type Butterfly Valve</a></h2>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="service-card">
                        <a href="lug-type-butterfly-valve.html">
                            <div class="image">
                                <img src="{{ asset('front_assets/assets/images/products/img-67.png') }}" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="lug-type-butterfly-valve.html">Lug Type Butterfly Valve</a></h2>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="service-card">
                        <a href="double-flanged-butterfly-valve.html">
                            <div class="image">
                                <img src="{{ asset('front_assets/assets/images/products/img-4.png') }}" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="double-flanged-butterfly-valve.html">Double Flanged Butterfly Valve</a></h2>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-12">
                    <div class="service-card">
                        <a href="double-offset-disc-design.html">
                            <div class="image">
                                <img src="{{ asset('front_assets/assets/images/products/img-68.png') }}" alt="">
                            </div>
                            <div class="content">
                                <h2><a href="double-offset-disc-design.html">Double Offset Disc Design</a></h2>
                            </div>
                        </a>
                    </div>
                </div>

            </div> --}}

            <div class="row">
                @foreach ($product_data as $product)
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="service-card">
                            <div class="image">
                                @php
                                    // Decode JSON array for product images
                                    $images = json_decode($product->image);
                                    $first_image = isset($images[0]) ? $images[0] : 'default-product.png';
                                @endphp
                                <img src="{{ asset('productImage/' . $first_image) }}" alt="{{ $product->title }}" style="height: 200px;">
                            </div>
                            <div class="content">
                                <h2>{{ $product->title }}</h2>
                                @if ($product->document)
                                    <p style="margin-top:10px;">
                                        <a href="{{ asset('ProductDocuments/' . $product->document) }}" target="_blank"
                                            style="
                                                    display: inline-flex;
                                                    align-items: center;
                                                    gap: 6px;
                                                    padding: 6px 12px;
                                                    background-color: #2073c6 ;
                                                    color: #fff;
                                                    border-radius: 30px;
                                                    text-decoration: none;
                                                    font-weight: 500;
                                                    transition: background-color 0.3s, transform 0.2s;
                                                "
                                            onmouseover="this.style.backgroundColor='#f44336'; this.style.transform='scale(1.05)';"
                                            onmouseout="this.style.backgroundColor='#2073c6 '; this.style.transform='scale(1)';">
                                            <img src="{{ asset('front_assets/assets/images/pdf-icon.png') }}"
                                                alt="PDF" style="width:20px; height:20px;">
                                            Download PDF
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="main-btn">
                <a href="{{ route('websiteCategoryList') }}">View More</a>
            </div>
        </div>
    </section>

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



    <section class="application">
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

    </section>
@endsection
