<!-- start of wpo-site-footer-section -->

<link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@php
    use App\Models\ContactInfo;

    $contact_data = ContactInfo::latest()->first();
@endphp

<footer class="wpo-site-footer">
    <div class="wpo-upper-footer">
        <div class="container">
            <div class="row">
                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget about-widget">
                        <div class="widget-title">
                            <h3>About Us</h3>
                        </div>
                        <p>We have a customer centric approach at NECON valves. Our knowledge in the domain blended with
                            the vast experience has enabled us to serve our customers with the best they need.</p>
                        <div class="we-support">
                            <div class="icon-img">
                                <img src="{{ asset('front_assets/assets/images/icon-1.png') }}" alt="">
                            </div>
                            <div class="icon-img">
                                <img src="{{ asset('front_assets/assets/images/icon-2.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="social-widget">
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        <div class="widget-title">
                            <h3>Quick Link</h3>
                        </div>
                        <ul>
                            <li><a href="{{ route('homeWebsite') }}">Home</a></li>
                            <li><a href="{{ route('aboutWebsite') }}">About Us</a></li>
                            <li><a href="{{ route('websiteCategoryList') }}">Products</a></li>
                            <li><a href="{{ route('qualityWebsite') }}">Quality</a></li>
                            <li><a href="{{ route('contactWebsite') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                {{-- <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        <div class="widget-title">
                            <h3>Products</h3>
                        </div>
                        <ul>
                            <li><a href="{{ route('productWebsite') }}">Butterfly Valves</a></li>
                            <li><a href="{{ route('productWebsite') }}">Ball Valves</a></li>
                            <li><a href="{{ route('productWebsite') }}">Gate Valves</a></li>
                            <li><a href="{{ route('productWebsite') }}">Globe Valves</a></li>
                            <li><a href="{{ route('productWebsite') }}">Check Valves</a></li>
                            <li><a href="{{ route('productWebsite') }}">Non Return Valves</a></li>
                        </ul>
                    </div>
                </div> --}}

                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        <div class="widget-title">
                            <h3>Products</h3>
                        </div>

                        @if (isset($latest_products) && $latest_products->count())
                            <ul>
                                @foreach ($latest_products as $product)
                                    <li>
                                        <a href="{{ route('productDetails', $product->id) }}"
                                            title="{{ $product->title }}">
                                            {{ \Illuminate\Support\Str::limit($product->title, 40) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No products to show.</p>
                        @endif

                    </div>
                </div>


                <!-- Dynamic Contact Info Start -->
                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget newsletter-widget">
                        <div class="widget-title">
                            <h3>Contact Us</h3>
                        </div>

                        @if ($contact_data)
                            <div class="address contact-footer">
                                <div class="icons">
                                    <i class="fi flaticon-placeholder"></i>
                                </div>
                                <div class="text">
                                    <h4>SHREENATH ENGINEERING</h4>
                                    <p>{!! $contact_data->address !!}</p>
                                </div>
                            </div>

                            <div class="number contact-footer">
                                <div class="icons">
                                    <i class="fi flaticon-phone-call"></i>
                                </div>
                                <div class="text">
                                    @foreach ($contact_data->phone as $phone)
                                        <a href="tel:{{ $phone }}">{{ $phone }}</a><br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mail contact-footer">
                                <div class="icons">
                                    <i class="fi flaticon-email"></i>
                                </div>
                                <div class="text">
                                    @foreach ($contact_data->email as $email)
                                        <a href="mailto:{{ $email }}">{{ $email }}</a><br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <!-- Dynamic Contact Info End -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</footer>

<div class="copyright-area">
    <div class="container">
        <div class="copyright-item">
            <div class="footer-bottom">
                <p class="text-center">Copyright @ 2025, SNM TechCraft Innovation All rights reserved. | Powered By <a
                        href="https://snmtc.in/" target="_blank">Software And Web Development Company in Ahmedabad </a>
                </p>
            </div>
        </div>
    </div>
</div>

<div id="socialBar">
    <a href="https://web.whatsapp.com/send?phone=+91%209998530462" target="_blank" class="desk_none">
        <img src="{{ asset('front_assets/assets/images/whatsapp-icon.png') }}" alt="" id="shareBtn">
    </a>
</div>

<div class="pogoda-hld">
    <div class="info-btn call-btn"> <a href="tel:+91 98255 30462"><i class="fi flaticon-phone-call"></i></a> </div>
</div>

<!-- All JavaScript files -->
<script src="{{ asset('front_assets/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('front_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front_assets/assets/js/modernizr.custom.js') }}"></script>
<script src="{{ asset('front_assets/assets/js/jquery-plugin-collection.js') }}"></script>
<script src="{{ asset('front_assets/assets/js/script.js') }}"></script>

</body>

</html>
