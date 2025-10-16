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

    {{-- START: About + Why ALTRIX Valves (About: description | image ; stable hover flip + click/tap + keyboard) --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    @php
        $aboutImageName = $about_data->image ?? null;
        $aboutImageFullPath = $aboutImageName ? public_path('AboutImage/' . $aboutImageName) : null;
        $hasAboutImage = $aboutImageFullPath && file_exists($aboutImageFullPath);
    @endphp

    <section class="about-why-section"
        style="padding:60px 0; background:#fff; font-family:Arial, sans-serif; position:relative; overflow:hidden;">
        <div class="container" style="position:relative; z-index:1;">
            <div class="row-two" data-aos="fade-up">

                <!-- LEFT: About Us -->
                <div class="col-left" data-aos="slide-right">
                    <div class="about-card">
                        <!-- Heading -->
                        <div class="about-header-row"
                            style="display:flex; align-items:center; justify-content:center; gap:12px;">
                            <div class="about-title-wrap" style="flex:1; text-align:center;">
                                <h2 class="about-heading" style="margin:0;">
                                    <span class="accent-red">About</span><span class="accent-blue"> Us</span>
                                </h2>
                            </div>
                        </div>

                        <!-- description | image -->
                        <div class="about-content-row"
                            style="
              display:flex;
              align-items:center;
              justify-content:space-between;
              gap:20px;
              margin-top:18px;
              flex-wrap:wrap;
          ">
                            <!-- Description (left) -->
                            <div class="about-text-wrap" style="flex:1 1 420px; min-width:220px;">
                                <div class="about-text"
                                    style="text-align:left; color:#555; line-height:1.7; font-size:15.5px;">
                                    {!! $about_data->description !!}
                                </div>

                                <!-- Discover button -->
                                <div style="margin-top:18px;">
                                    <a href="{{ route('aboutWebsite') }}" class="btn-discover"
                                        style="display:inline-block; background:linear-gradient(45deg,#ff0000,#003c95); color:#fff; padding:10px 22px; border-radius:8px; text-decoration:none; font-weight:600; box-shadow:0 10px 20px rgba(0,0,0,0.08);">
                                        Discover Now
                                    </a>
                                </div>
                            </div>

                            <!-- Image (right) -->
                            <div class="about-side-image-wrap" style="flex:0 0 320px; min-width:180px;">
                                @if ($hasAboutImage)
                                    <img src="{{ asset('AboutImage/' . $aboutImageName) }}" alt="About image"
                                        style="width:100%%; height:240px; object-fit:cover; border-radius:10px;">
                                @else
                                    <!-- Placeholder if no image provided -->
                                    <div
                                        style="width:100%; height:240px; display:flex; align-items:center; justify-content:center; border-radius:10px; background:#f3f6fb; color:#7a8aa3; box-shadow:0 12px 30px rgba(0,0,0,0.04);">
                                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" rx="4" fill="#eef2ff"></rect>
                                            <path d="M7 14l3-4 4 5 3-4 2 5H7z" stroke="#003c95" stroke-width="1.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT: Why ALTRIX Valves? -->
                <div class="col-right" data-aos="slide-left">
                    <h3 class="section-title-right"
                        style="text-align:center; font-size:34px; font-weight:800; margin:0 0 18px;">
                        <span class="accent-blue">Why</span><span class="accent-red"> ALTRIX</span><span
                            class="accent-blue"> Valves?</span>
                    </h3>

                    <div class="cards-grid"
                        style="display:grid; grid-template-columns: repeat(2, 1fr); gap:18px; align-items:stretch;">
                        @foreach ($goal_data as $goal)
                            @php
                                $goalImg = $goal->image ?? null;
                                $goalImgFull = $goalImg ? public_path('GoalImage/' . $goalImg) : null;
                                $hasGoalImg = $goalImgFull && file_exists($goalImgFull);
                                $short = \Illuminate\Support\Str::limit(strip_tags($goal->description ?? ''), 120);
                            @endphp

                            <div class="card-link" title="{{ $goal->title }}">
                                <div class="flip-card" tabindex="0" role="button" aria-pressed="false">
                                    <div class="flip-card-inner">
                                        <!-- FRONT -->
                                        <div class="flip-card-front">
                                            <div class="card-top" style="display:flex; gap:12px; align-items:center;">
                                                <div class="card-icon" style="width:56px; height:56px;">
                                                    @if ($hasGoalImg)
                                                        <img src="{{ asset('GoalImage/' . $goalImg) }}"
                                                            alt="{{ $goal->title }}"
                                                            style="width:56px; height:56px; object-fit:cover; border-radius:8px; box-shadow:0 8px 18px rgba(0,0,0,0.06);">
                                                    @else
                                                        <svg width="56" height="56" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            style="border-radius:8px;background:#fff;">
                                                            <rect width="24" height="24" rx="4"
                                                                fill="#eef2ff"></rect>
                                                            <path d="M12 7v6l4 2" stroke="#003c95" stroke-width="1.4"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <h4 class="card-title"
                                                    style="color:#ff0000; font-weight:700; margin:0; font-size:16px;">
                                                    {{ $goal->title }}</h4>
                                            </div>
                                            <p class="card-desc" style="color:#666; font-size:14px; margin:10px 0;">
                                                {{ $short }}</p>
                                            <div class="card-foot" style="text-align:right;">
                                                <span class="card-cta" style="color:#003c95; font-weight:700;">Read</span>
                                            </div>
                                        </div>

                                        <!-- BACK -->
                                        <div class="flip-card-back">
                                            <h4 class="back-title"
                                                style="color:#003c95; font-weight:700; margin:0 0 8px;">{{ $goal->title }}
                                            </h4>
                                            <p class="back-desc" style="color:#333; font-size:14px;">
                                                {!! nl2br(e($goal->description)) !!}</p>
                                            <div class="back-foot" style="text-align:right;">
                                                <span class="back-cta" style="color:#003c95; font-weight:700;">Learn more
                                                    →</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <style>
            /* Colors */
            .accent-red {
                color: #ff0000;
            }

            .accent-blue {
                color: #003c95;
            }

            /* Layout */
            .row-two {
                display: flex;
                gap: 30px;
                flex-wrap: wrap;
                align-items: stretch;
            }

            .col-left,
            .col-right {
                flex: 1 1 50%;
                min-width: 280px;
            }

            .about-card {
                background: #fff;
                padding: 18px;
                border-radius: 12px;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                min-height: 420px;
                position: relative;
                z-index: 1;
            }

            .about-heading {
                font-size: 28px;
                font-weight: 800;
                margin: 0;
            }

            .about-text {
                line-height: 1.7;
                font-size: 15.5px;
                color: #555;
            }

            .section-title-right {
                font-size: 32px;
                font-weight: 800;
                margin: 0 0 12px;
                text-align: center;
            }

            .section-title-right::after {
                content: '';
                display: block;
                width: 64px;
                height: 4px;
                margin: 10px auto 0;
                border-radius: 4px;
                background: linear-gradient(45deg, #ff0000, #003c95);
            }

            /* Cards grid */
            .cards-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
                align-items: stretch;
            }

            .card-link {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
                overflow: visible;
            }

            /* ===== FLIP CARD: conflict-free implementation ===== */
            .flip-card {
                perspective: 1200px;
                cursor: pointer;
                margin-bottom: 16px;
                transition: transform 0.25s ease;
                will-change: transform;
                -webkit-tap-highlight-color: transparent;
            }

            /* Lift on hover: apply only translate to wrapper (no rotate here) */
            @media (hover: hover) and (pointer: fine) {
                .flip-card:hover {
                    transform: translateY(-6px);
                }
            }

            /* The rotating container */
            .flip-card-inner {
                position: relative;
                width: 100%;
                min-height: 180px;
                transition: transform 0.65s cubic-bezier(.2, .9, .3, 1);
                transform-style: preserve-3d;
                -webkit-transform-style: preserve-3d;
                will-change: transform;
            }

            /* Front and Back faces */
            .flip-card-front,
            .flip-card-back {
                position: absolute;
                inset: 0;
                border-radius: 10px;
                padding: 16px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
                backface-visibility: hidden;
                -webkit-backface-visibility: hidden;
                box-sizing: border-box;
                /* Ensure faces don't get transformed unexpectedly */
                transform: none;
            }

            /* Explicit face rotations */
            .flip-card-front {
                transform: rotateY(0deg);
                z-index: 2;
                background: linear-gradient(180deg, #fff, #f7fbff);
            }

            .flip-card-back {
                transform: rotateY(180deg);
                z-index: 1;
                background: linear-gradient(180deg, #f7fbff, #eef6ff);
                overflow: auto;
            }

            /* Hover triggers rotation on inner (non-touch devices) */
            @media (hover: hover) and (pointer: fine) {
                .flip-card:hover .flip-card-inner {
                    transform: rotateY(180deg);
                }

                /* apply visual lift to faces via box-shadow / border-image (no transform) */
                .flip-card:hover .flip-card-front,
                .flip-card:hover .flip-card-back {
                    border-image-source: linear-gradient(45deg, #ff0000, #003c95);
                    border-image-slice: 1;
                    border-image-width: 1;
                    box-shadow: 0 18px 40px rgba(3, 12, 60, 0.12), 0 2px 8px rgba(0, 0, 0, 0.06);
                }
            }

            /* JS toggled flipped class (for touch/click) */
            .flip-card.flipped .flip-card-inner {
                transform: rotateY(180deg);
            }

            .flip-card.flipped .flip-card-front {
                z-index: 1;
            }

            .flip-card.flipped .flip-card-back {
                z-index: 2;
            }

            /* ensure content remains visible and readable after flip */
            .flip-card-front *,
            .flip-card-back * {
                -webkit-transform-style: preserve-3d;
                transform-style: preserve-3d;
            }

            /* Responsive */
            @media(max-width:992px) {
                .cards-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .about-side-image-wrap img {
                    height: 200px;
                }
            }

            @media(max-width:768px) {
                .row-two {
                    flex-direction: column;
                }

                .cards-grid {
                    grid-template-columns: 1fr;
                }

                .about-content-row {
                    flex-direction: column-reverse;
                    align-items: center;
                }

                .about-side-image-wrap {
                    flex: 0 0 auto;
                    width: 100%;
                }

                .about-side-image-wrap img {
                    width: 100%;
                    height: 220px;
                    object-fit: cover;
                }

                .about-text-wrap {
                    width: 100%;
                    text-align: center;
                }
            }
        </style>
    </section>

    <script>
        // Initialize AOS reliably
        if (window.AOS) AOS.init({
            duration: 900,
            once: true,
            easing: 'ease-out'
        });

        // Flip cards: click/tap for touch devices, keyboard support.
        document.addEventListener('DOMContentLoaded', () => {
            const flipCards = document.querySelectorAll('.flip-card');

            flipCards.forEach(card => {
                // ensure focusable
                if (!card.hasAttribute('tabindex')) card.setAttribute('tabindex', '0');

                // For accessibility: role + aria
                card.setAttribute('role', 'button');

                // Click / tap toggles for touch devices (also works on desktop)
                card.addEventListener('click', (e) => {
                    // Toggle class - hover still works for desktop
                    card.classList.toggle('flipped');

                    // clear previous timeout
                    if (card.__unflipTimeout) clearTimeout(card.__unflipTimeout);
                    // Auto unflip after 6s
                    card.__unflipTimeout = setTimeout(() => card.classList.remove('flipped'), 6000);
                }, {
                    passive: true
                });

                // Keyboard: Enter or Space toggles flip
                card.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        card.classList.toggle('flipped');
                        if (card.__unflipTimeout) clearTimeout(card.__unflipTimeout);
                        card.__unflipTimeout = setTimeout(() => card.classList.remove('flipped'),
                            6000);
                    }
                });
            });
        });
    </script>
    {{-- END section --}}




    {{-- Full width featured products marquee infinite loop --}}
    @php
        $items = $product_data->values();
    @endphp

    <section class="wpo-service-section-s2 section-padding">
    <div class="container-fluid">

        {{-- Section Title --}}
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="wpo-section-title-s2">
                    <h2>
                        <span style="color:#0e395b; font-size:34px">Our</span>
                        <span style="color:#e31e24; font-size:34px"> Featured </span>
                        <span style="color:#0e395b ; font-size:34px">Products</span>
                    </h2>
                </div>
            </div>
        </div>

        {{-- Marquee wrapper full width --}}
        <div class="products-marquee-wrapper-full" aria-label="Featured products marquee" role="region">
            <div class="products-track-full">
                {{-- Original items --}}
                @foreach ($product_data as $product)
                    @php
                        $first_image = 'default-product.png';
                        if (!empty($product->image)) {
                            $images = json_decode($product->image);
                            if (is_array($images) && !empty($images)) {
                                $first_image = $images[0];
                            }
                        }
                    @endphp

                    {{-- Product Item --}}
                    <div class="marq-item marq-product">
                        <div class="product-card">
                            <a href="#" class="product-image-link" aria-label="{{ $product->title }}">
                                <div class="product-image">
                                    <img src="{{ asset('productImage/' . $first_image) }}" alt="{{ $product->title }}">
                                </div>
                            </a>
                            <div class="product-content">
                                <h3 class="product-title" title="{{ $product->title }}">{{ $product->title }}</h3>
                                @if ($product->document)
                                    <a href="{{ asset('ProductDocuments/' . $product->document) }}" target="_blank" class="pdf-download-btn">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>Download PDF</span>
                                    </a>
                                @else
                                    <div class="pdf-download-placeholder"></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Connector Logo after EVERY product --}}
                    <div class="marq-item marq-connector">
                        <div class="connector-logo" style="border:2px solid #0e395b;">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </div>
                    </div>
                @endforeach

                {{-- Duplicate items for seamless loop --}}
                @foreach ($product_data as $product)
                    @php
                        $first_image = 'default-product.png';
                        if (!empty($product->image)) {
                            $images = json_decode($product->image);
                            if (is_array($images) && !empty($images)) {
                                $first_image = $images[0];
                            }
                        }
                    @endphp

                    {{-- Product Item --}}
                    <div class="marq-item marq-product">
                        <div class="product-card">
                            <a href="#" class="product-image-link" aria-label="{{ $product->title }}">
                                <div class="product-image">
                                    <img src="{{ asset('productImage/' . $first_image) }}" alt="{{ $product->title }}">
                                </div>
                            </a>
                            <div class="product-content">
                                <h3 class="product-title" title="{{ $product->title }}">{{ $product->title }}</h3>
                                @if ($product->document)
                                    <a href="{{ asset('ProductDocuments/' . $product->document) }}" target="_blank" class="pdf-download-btn">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>Download PDF</span>
                                    </a>
                                @else
                                    <div class="pdf-download-placeholder"></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Connector Logo after EVERY product --}}
                    <div class="marq-item marq-connector">
                        <div class="connector-logo" style="border:2px solid #0e395b;">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- View More --}}
        <div class="text-center mt-4">
            <a href="{{ route('websiteCategoryList') }}" class="pdf-download-btn view-more-btn">View More Products</a>
        </div>
    </div>
</section>

<style>
    .products-marquee-wrapper-full {
        width: 100%;
        overflow: hidden;
        padding: 12px 0;
        background: #fff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        border-radius: 10px;
        position: relative;
    }

    .products-track-full {
        display: flex;
        gap: 18px;
        animation: products-scroll-full 30s linear infinite;
        width: max-content;
        will-change: transform;
    }

    .marq-item {
        flex: 0 0 auto;
        box-sizing: border-box;
    }

    .marq-product {
        width: 220px;
    }

    .marq-connector {
        width: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .connector-logo {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
    }

    .connector-logo img {
        width: 36px;
        height: 36px;
        object-fit: contain;
        opacity: 0.95;
    }

    .product-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        transition: transform .3s ease, box-shadow .3s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid #e31e24;
    }

    .product-image {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        padding: 10px;
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: block;
    }

    .product-content {
        padding: 12px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        min-height: 120px;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        color: #0e395b;
        margin: 0;
        line-height: 1.2;
        height: 2.4em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        text-align: center;
    }

    .pdf-download-btn,
    .pdf-download-placeholder {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 14px;
        background: #0e395b;
        color: #fff;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 500;
        font-size: .88rem;
        border: none;
        cursor: pointer;
        width: 160px;
        height: 40px;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .pdf-download-btn:hover,
    .view-more-btn:hover {
        background: #e31e24;
        transform: scale(1.03);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .view-more-btn {
        display: inline-block;
        padding: 12px 30px;
        background: #0e395b;
        color: #fff;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 2px solid #0e395b;
    }

    .view-more-btn:hover {
        background: #e31e24;
        border-color: #e31e24;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(227, 30, 36, 0.3);
    }

    /* Perfect seamless animation */
    @keyframes products-scroll-full {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /* Pause animation on hover */
    .products-marquee-wrapper-full:hover .products-track-full {
        animation-play-state: paused;
    }

    /* Responsive styles */
    @media(max-width: 992px) {
        .marq-product {
            width: 180px;
        }
        
        .product-image {
            height: 150px;
        }
        
        .products-track-full {
            animation-duration: 25s;
        }
    }

    @media(max-width: 768px) {
        .marq-product {
            width: 160px;
        }
        
        .marq-connector {
            width: 50px;
        }
        
        .connector-logo {
            width: 40px;
            height: 40px;
        }
        
        .connector-logo img {
            width: 30px;
            height: 30px;
        }
        
        .product-image {
            height: 130px;
        }
        
        .product-content {
            min-height: 110px;
            padding: 10px;
        }
        
        .product-title {
            font-size: 0.9rem;
        }
        
        .pdf-download-btn,
        .pdf-download-placeholder {
            width: 140px;
            height: 36px;
            font-size: 0.8rem;
            padding: 6px 12px;
        }
        
        .products-track-full {
            animation-duration: 20s;
            gap: 15px;
        }
    }

    @media(max-width: 576px) {
        .marq-product {
            width: 140px;
        }
        
        .marq-connector {
            display: none;
        }
        
        .products-track-full {
            gap: 12px;
            animation-duration: 15s;
        }
        
        .product-image {
            height: 120px;
        }
        
        .product-content {
            min-height: 100px;
        }
        
        .product-title {
            font-size: 0.85rem;
        }
        
        .pdf-download-btn,
        .pdf-download-placeholder {
            width: 120px;
            height: 32px;
            font-size: 0.75rem;
            padding: 5px 10px;
        }
    }
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
                        @if ($choose_data->first())
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
                        @if ($choose_data->first())
                            @php
                                $points_titles = $choose_data->first()->points_title; // already an array
                                $points_images = $choose_data->first()->points_image; // already an array
                            @endphp

                            @foreach ($points_titles as $index => $point)
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
                @foreach ($achievement_data as $achievement)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="item">
                            <div class="icon">
                                <img src="{{ asset('AchievementImage/' . $achievement->image) }}"
                                    alt="{{ $achievement->title }}">
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
