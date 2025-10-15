@extends('Front.Layout.main')

@section('main-container')
<section class="page-banner" style="background-image: url({{ asset('front_assets/assets/images/about-banner.jpg') }});">
    <div class="container">
        <div class="page-banner-tilte">
            <h2>Our Products</h2>
        </div>
    </div>
</section>

<section class="wpo-service-section-s2 section-padding">
    <div class="container">
        {{-- 1. Modern Category Tabs --}}
        <div class="category-tabs-wrapper">
            <a href="{{ route('websiteCategoryList') }}"
                class="nav-link {{ !$selectedCategory ? 'active' : '' }}">
                All Products
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('websiteCategoryList.id', $cat->id) }}"
                    class="nav-link {{ $selectedCategory && $selectedCategory->id == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- 2. Product Grid --}}
        <div class="row">
            {{-- Determine which product list to use --}}
            @php
                $productsToShow = $selectedCategory ? $categoryProducts : $allProducts;
            @endphp

            @forelse($productsToShow as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <a href="{{ route('productDetails', $product->id) }}" class="product-card-link">
                        <div class="product-card">
                            <div class="product-image">
                                @php
                                    $productImage = $product->image ? $product->image : null;
                                    // Handle JSON string case
                                    if ($productImage && is_string($productImage) && str_contains($productImage, '["')) {
                                        $imagesArray = json_decode($productImage, true);
                                        $productImage = is_array($imagesArray) ? end($imagesArray) : $productImage;
                                    }
                                @endphp

                                @if ($productImage)
                                    <img src="{{ asset('ProductImage/' . $productImage) }}" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('front_assets/assets/images/products/img-placeholder.png') }}" alt="{{ $product->title }}">
                                @endif
                            </div>
                            <div class="product-content">
                                <h3 class="product-title">{{ $product->title }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        @if($selectedCategory)
                            No products found in the "{{ $selectedCategory->name }}" category.
                        @else
                            No products found.
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* --- Banner Enhancement --- */
    .page-banner {
        position: relative;
    }
    .page-banner::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.35); /* Dark overlay for better text visibility */
        z-index: 1;
    }
    .page-banner .container {
        position: relative;
        z-index: 2;
    }

    /* --- 1. New Modern Category Tabs Styling --- */
    .category-tabs-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap; /* Allows tabs to wrap on smaller screens */
        gap: 12px; /* Space between tabs */
        margin-bottom: 50px;
    }
    .category-tabs-wrapper .nav-link {
        color: #495057;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 50px; /* Pill shape */
        padding: 10px 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 1rem;
    }
    .category-tabs-wrapper .nav-link:hover {
        background-color: #e31e24 !important;
        color: #000;
        border-color: #ced4da;
    }
    .category-tabs-wrapper .nav-link.active {
        background:#0e395b;
        color: #fff;
        border-color: transparent;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
    }


    /* --- 2. Improved Product Card Styling --- */
    .product-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .product-card {
        height: 300px; /* Increased height for better proportions */
        display: flex;
        flex-direction: column;
        border: 1px solid #e9ecef; /* Softer border */
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #ffffff;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .product-image {
        height: 200px; /* Taller image area */
        overflow: hidden;
        padding: 10px; /* Padding to prevent image from touching edges */
        background-color: #fff;
    }
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Use 'contain' to show the full image without cropping */
        transition: transform 0.4s ease;
    }
    .product-card:hover .product-image img {
        transform: scale(1.06); /* Slightly bigger zoom on hover */
    }
    .product-content {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        align-items: center; /* Vertically center the title */
        justify-content: center;
        text-align: center;
        border-top: 1px solid #e9ecef; /* Separator line */
        background-color: #fdfdfd;
    }
    .product-title {
        font-size: 1rem;
        font-weight: 600;
        color: #343a40;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit title to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection