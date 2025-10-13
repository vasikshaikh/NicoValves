@extends('Front.Layout.main')

@section('main-container')
<section class="page-banner" style="background-image: url({{ asset('front_assets/assets/images/about-banner.jpg') }});">
    <div class="container">
        <div class="page-banner-tilte">
            <h2>Products</h2>
        </div>
    </div>
</section>

<section class="wpo-service-section-s2 section-padding">
    <div class="container">
        <div id="exTab2">
            <div class="panel panel-default">
                {{-- Panel Heading: Tabs --}}
                <div class="panel-heading">
                    <div class="panel-title">
                        <ul class="nav nav-tabs" role="tablist">
                            {{-- "All" tab --}}
                            <li class="{{ !$selectedCategory ? 'active' : '' }}">
                                <a href="{{ route('websiteCategoryList') }}">All</a>
                            </li>

                            {{-- Dynamic category tabs --}}
                            @foreach ($categories as $cat)
                                <li class="{{ $selectedCategory && $selectedCategory->id == $cat->id ? 'active' : '' }}">
                                    <a href="{{ route('websiteCategoryList.id', $cat->id) }}">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Panel Body --}}
                <div class="panel-body">
                    <div class="row">
                        {{-- Show ALL products if no category selected --}}
                        @if(!$selectedCategory)
                            @forelse($allProducts as $product)
                                <div class="col-lg-3 col-md-4 col-6 mb-4">
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
                                                    <img src="{{ asset('ProductImage/' . $productImage) }}" alt="{{ $product->title }}" class="img-fluid">
                                                @else
                                                    <img src="{{ asset('front_assets/assets/images/products/img-placeholder.png') }}" alt="{{ $product->title }}" class="img-fluid">
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
                                    <div class="alert alert-info">No products found.</div>
                                </div>
                            @endforelse
                        @else
                            {{-- Show products of the selected category --}}
                            @forelse($categoryProducts as $product)
                                <div class="col-lg-3 col-md-4 col-6 mb-4">
                                    <a href="{{ route('productDetails', $product->id) }}" class="product-card-link">
                                        <div class="product-card">
                                            <div class="product-image">
                                                @php
                                                    $productImage = $product->image ? $product->image : null;
                                                    if ($productImage && is_string($productImage) && str_contains($productImage, '["')) {
                                                        $imagesArray = json_decode($productImage, true);
                                                        $productImage = is_array($imagesArray) ? end($imagesArray) : $productImage;
                                                    }
                                                @endphp

                                                @if ($productImage)
                                                    <img src="{{ asset('ProductImage/' . $productImage) }}" alt="{{ $product->title }}" class="img-fluid">
                                                @else
                                                    <img src="{{ asset('front_assets/assets/images/products/img-placeholder.png') }}" alt="{{ $product->title }}" class="img-fluid">
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
                                    <div class="alert alert-info">No products found in {{ $selectedCategory->name }} category.</div>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Your existing CSS styles here */
.product-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.product-card-link:hover {
    text-decoration: none;
    color: inherit;
}

.product-card {
    height: 280px;
    display: flex;
    flex-direction: column;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: #fff;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.product-image {
    height: 180px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    padding: 0;
    margin: 0;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-content {
    padding: 12px 10px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin: 0;
}

.product-title {
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #333;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    width: 100%;
}

/* Active tab styling */
.nav-tabs > li.active > a {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
}

.nav-tabs > li > a {
    color: #333;
    text-decoration: none;
    padding: 8px 15px;
    display: block;
    border: 1px solid #ddd;
    border-radius: 4px 4px 0 0;
    margin-right: 5px;
}

.nav-tabs > li > a:hover {
    background-color: #f8f9fa;
}

.nav-tabs {
    border-bottom: 1px solid #ddd;
    display: flex;
    flex-wrap: wrap;
}

.nav-tabs > li {
    margin-bottom: -1px;
}
</style>
@endsection
