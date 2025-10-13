@extends('Front.Layout.main')

@section('main-container')
<section class="page-banner" style="background-image: url({{ asset('front_assets/assets/images/about-banner.jpg') }});">
    <div class="container">
        <div class="page-banner-tilte">
            <h2>{{ $product->title }} Details</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('websiteCategoryList') }}">Products</a></li> --}}
                    @if($product->category)
                    {{-- <li class="breadcrumb-item"><a href="{{ route('websiteCategoryList.id', $product->category_id) }}">{{ $product->category->name }}</a></li> --}}
                    @endif
                    {{-- <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li> --}}
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="page-details">
    <div class="container">
        <div class="row">
            <div class="page-main-heading">
                <h2>{{ $product->title }} Details</h2>
            </div>

            <div class="col-md-6">
                <div class="slider-heading" >
                    <h3 style="color: black;">{{ $product->title }}</h3>
                </div>

                <div class="main">
                    @php
                        // Handle multiple images from database
                        $productImages = [];
                        if ($product->image) {
                            if (is_array($product->image)) {
                                $productImages = $product->image;
                            } else if (is_string($product->image) && str_contains($product->image, '["')) {
                                $imagesArray = json_decode($product->image, true);
                                $productImages = is_array($imagesArray) ? $imagesArray : [$product->image];
                            } else {
                                $productImages = [$product->image];
                            }
                        }

                        // Agar koi image nahi hai toh placeholder use karein
                        if (empty($productImages)) {
                            $productImages = ['img-placeholder.png'];
                        }
                    @endphp

                    <div class="slider slider-for">
                        @foreach($productImages as $image)
                        <div class="slider-big-image">
                            <div class="product-slider-image">
                                @if($image == 'img-placeholder.png')
                                    <img src="{{ asset('front_assets/assets/images/products/' . $image) }}" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('ProductImage/' . $image) }}" alt="{{ $product->title }}">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(count($productImages) > 1)
                    <div class="slider slider-nav">
                        @foreach($productImages as $image)
                        <div class="slider-small-image">
                            <div class="product-slider-image">
                                @if($image == 'img-placeholder.png')
                                    <img src="{{ asset('front_assets/assets/images/products/' . $image) }}" alt="{{ $product->title }}">
                                @else
                                    <img src="{{ asset('ProductImage/' . $image) }}" alt="{{ $product->title }}">
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="product-detail-btns">
                    <div class="row">
                        @if($product->document)
                        <div class="col-md-4 btn-w">
                            <div class="list-btn">
                                <a href="{{ asset('ProductDocument/' . $product->document) }}" download>
                                    <i class="fas fa-download"></i> Download Document
                                </a>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-4 btn-w">
                            <div class="list-btn">
                                <a href="#" id="contact">Price Enquiry</a>
                                <div id="contactForm">
                                    <h2>Product Enquiry</h2>
                                    <form action="{{ route('contactWebsite') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input placeholder="Company Name" type="text" name="company_name" required />
                                        <input placeholder="Email" type="email" name="email" required />
                                        <input placeholder="Phone" type="text" name="phone" required />
                                        <textarea placeholder="Message" name="message" rows="3"></textarea>
                                        <input class="formBtn" type="submit" value="Submit" />
                                        <input class="formBtn" type="reset" value="Reset" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="product-table-details">
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <h4>Product Information</h4>
                                </td>
                            </tr>

                            @if($product->category)
                            <tr>
                                <td class="list-left">Category</td>
                                <td class="list-rigt">
                                    <a href="{{ route('websiteCategoryList.id', $product->category_id) }}">
                                        {{ $product->category->name }}
                                    </a>
                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td class="list-left">Product Title</td>
                                <td class="list-rigt">{{ $product->title }}</td>
                            </tr>

                            @if($product->document)
                            <tr>
                                <td class="list-left">Document</td>
                                <td class="list-rigt">
                                    <a href="{{ asset('ProductDocument/' . $product->document) }}" download style="    color: black;"
                                        <i class="fas fa-file-pdf"></i> {{ $product->document }}
                                    </a>
                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td class="list-left">Created Date</td>
                                <td class="list-rigt">{{ $product->created_at->format('d M, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="product-description-section mt-4">
                    <h4>Product Description</h4>
                    <div class="description-content">
                        @if($product->description)
                            {!! $product->description !!}
                        @else
                            <p class="text-muted">No description available for this product.</p>
                        @endif
                    </div>
                </div>

                <div class="product-actions mt-4">
                    <a href="https://wa.me/919876543210?text=Hi, I'm interested in {{ $product->title }}"
                       class="btn btn-success btn-lg me-3" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp Inquiry
                    </a>
                    <a href="tel:+919876543210" class="btn btn-lg" style="background-color: rgb(38, 97, 157) ; color: white;">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Products Section --}}
        @if($relatedProducts->count() > 0)
        <div class="related-products-section mt-5">
            <div class="section-header">
                <h3>Related Products</h3>
                <p>Explore similar products in our catalog</p>
            </div>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <a href="{{ route('productDetails', $relatedProduct->id) }}" class="product-card-link">
                        <div class="product-card">
                            <div class="product-image">
                                @php
                                    $relatedProductImage = $relatedProduct->image ? $relatedProduct->image : null;
                                    if ($relatedProductImage && is_string($relatedProductImage) && str_contains($relatedProductImage, '["')) {
                                        $imagesArray = json_decode($relatedProductImage, true);
                                        $relatedProductImage = is_array($imagesArray) ? end($imagesArray) : $relatedProductImage;
                                    }
                                @endphp

                                @if ($relatedProductImage)
                                    <img src="{{ asset('ProductImage/' . $relatedProductImage) }}" alt="{{ $relatedProduct->title }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('front_assets/assets/images/products/img-placeholder.png') }}" alt="{{ $relatedProduct->title }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="product-content">
                                <h3 class="product-title">{{ $relatedProduct->title }}</h3>
                                @if($relatedProduct->category)
                                    <small class="text-muted">{{ $relatedProduct->category->name }}</small>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="main-btn protucts-btn pt-50">
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Previous Page
            </a>
        </div>
    </div>
</section>

<!-- JavaScript for Slider and Contact Form -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">

<script>
$(document).ready(function(){
    // Slick slider initialization
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-nav',
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });

    @if(count($productImages) > 1)
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });
    @endif

    // Contact form toggle
    $('#contact').click(function(e) {
        e.preventDefault();
        $('#contactForm').toggle();
    });

    // Close contact form when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#contact, #contactForm').length) {
            $('#contactForm').hide();
        }
    });
});
</script>

<style>
/* Additional styles for the product detail page */
.page-details {
    padding: 50px 0;
}

.page-main-heading {
    width: 100%;
    margin-bottom: 30px;
    text-align: center;
}

.page-main-heading h2 {
    font-size: 32px;
    color: #333;
    font-weight: 600;
}

.slider-heading h3 {
    font-size: 24px;
    color: #007bff;
    margin-bottom: 20px;
}

.product-slider-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 8px;
}

.slider-big-image {
    padding: 10px;
}

.slider-small-image {
    padding: 5px;
    cursor: pointer;
}

.slider-small-image img {
    border: 2px solid transparent;
    transition: border-color 0.3s ease;
    height: 200px;
    object-fit: cover;
}

.slider-small-image.slick-current img {
    border-color: #007bff;
}

.slick-prev, .slick-next {
    background: rgba(0,0,0,0.5);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    z-index: 1;
}

.slick-prev:hover, .slick-next:hover {
    background: rgba(0,0,0,0.8);
}

.slick-prev {
    left: 10px;
}

.slick-next {
    right: 10px;
}

.product-detail-btns {
    margin-top: 30px;
}

.list-btn {
    margin-bottom: 15px;
}

/* .list-btn a {
    display: block;
    padding: 12px 20px;
    background: #007bff;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
} */

.list-btn a:hover {
    background: #0056b3;
    text-decoration: none;
    color: white;
}

.product-table-details {
    margin-bottom: 30px;
}

.product-table-details table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.product-table-details td {
    padding: 15px;
    border: 1px solid #e9ecef;
    vertical-align: top;
}

.list-left {
    font-weight: 600;
    background: #f8f9fa;
    width: 30%;
    color: #495057;
}

.list-rigt {
    width: 70%;
    color: #6c757d;
}

.product-description-section h4 {
    color: #333;
    margin-bottom: 15px;
    font-size: 20px;
}

.description-content {
    line-height: 1.6;
    color: #555;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left:4px solid #2073c6;
}

.product-actions .btn {
    margin-bottom: 10px;
}

.related-products-section {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 10px;
}

.section-header {
    text-align: center;
    margin-bottom: 30px;
}

.section-header h3 {
    font-size: 28px;
    color: #333;
    margin-bottom: 10px;
}

.section-header p {
    color: #6c757d;
    font-size: 16px;
}

/* Contact Form Styles */
#contactForm {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(0,0,0,0.3);
    z-index: 1000;
    width: 90%;
    max-width: 400px;
}

#contactForm h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
    font-size: 24px;
}

#contactForm input, #contactForm textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

#contactForm textarea {
    resize: vertical;
    min-height: 80px;
}

#contactForm .formBtn {
    width: 48%;
    display: inline-block;
    margin-right: 2%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
}

#contactForm .formBtn[type="submit"] {
    background: #28a745;
    color: white;
}

#contactForm .formBtn[type="reset"] {
    background: #6c757d;
    color: white;
}

#contactForm .formBtn:hover {
    opacity: 0.9;
}

/* Product Card Styles */
.product-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
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
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.product-image {
    height: 180px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-content {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
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
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-main-heading h2 {
        font-size: 24px;
    }

    .slider-heading h3 {
        font-size: 20px;
    }

    .product-slider-image img {
        height: 250px;
    }

    .list-left,
    .list-rigt {
        width: 100%;
        display: block;
    }

    .product-table-details td {
        display: block;
        width: 100%;
    }

    .related-products-section {
        padding: 20px;
    }

    .product-actions .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>
@endsection
