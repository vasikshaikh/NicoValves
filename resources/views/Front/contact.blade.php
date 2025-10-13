@extends('Front.Layout.main')

@section('main-container')
    <section class="page-banner" style="background-image: url('{{ asset('front_assets/assets/images/about-banner.jpg') }}');">
        <div class="container">
            <div class="page-banner-tilte">
                <h2>Contact Us</h2>
            </div>
        </div>
    </section>

    <section class="wpo-contact-pg-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-lg-10 offset-lg-1">
                    <div class="office-info">
                        <div class="row">
                            @php
                                // Contact images
                                $addressImg = null;
                                $phoneImg = null;
                                $emailImg = null;

                                if (!empty($contact_data)) {
                                    if (!empty($contact_data->address_image)) {
                                        $addressImg = $contact_data->address_image;
                                    }
                                    if (!empty($contact_data->phone_image)) {
                                        $phoneImg = $contact_data->phone_image;
                                    }
                                    if (!empty($contact_data->email_image)) {
                                        $emailImg = $contact_data->email_image;
                                    }

                                    // parse phone and email which might be JSON arrays or comma lists
                                    $phones = [];
                                    if (!empty($contact_data->phone)) {
                                        if (is_array($contact_data->phone)) {
                                            $phones = $contact_data->phone;
                                        } else {
                                            $decoded = json_decode($contact_data->phone, true);
                                            if (is_array($decoded)) {
                                                $phones = $decoded;
                                            } else {
                                                $p = preg_replace('/[\[\]\"]/', '', $contact_data->phone);
                                                $phones = array_filter(array_map('trim', explode(',', $p)));
                                            }
                                        }
                                    }

                                    $emails = [];
                                    if (!empty($contact_data->email)) {
                                        if (is_array($contact_data->email)) {
                                            $emails = $contact_data->email;
                                        } else {
                                            $decoded = json_decode($contact_data->email, true);
                                            if (is_array($decoded)) {
                                                $emails = $decoded;
                                            } else {
                                                $e = preg_replace('/[\[\]\"]/', '', $contact_data->email);
                                                $emails = array_filter(array_map('trim', explode(',', $e)));
                                            }
                                        }
                                    }

                                    // address as plain string
                                    $address = $contact_data->address ?? null;
                                } else {
                                    $phones = [];
                                    $emails = [];
                                    $address = null;
                                }
                            @endphp

                            {{-- Address --}}
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            @if (!empty($addressImg))
                                                <img src="{{ asset('ContactImage/' . $addressImg) }}" alt="address icon"
                                                    style="max-width:48px;">
                                            @else
                                                <i class="fi flaticon-placeholder"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Address</h2>
                                        <h5>SHREENATH ENGINEERING</h5>

                                        @if (!empty($address))
                                            <p style="white-space: pre-line;">
                                                {!! nl2br(e($address)) !!}
                                            </p>
                                        @else
                                            <p>Plot No. : B/22, Zaveri Estate, Nr.Kathwada G.I.D.C., Kathwada-Singarva Rd,
                                                Kathwada, Ahmedabad -382430 Gujarat, INDIA.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            @if (!empty($emailImg))
                                                <img src="{{ asset('ContactImage/' . $emailImg) }}" alt="email icon"
                                                    style="max-width:48px;">
                                            @else
                                                <i class="fi flaticon-email"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Email Us</h2>

                                        @if (!empty($emails))
                                            @foreach ($emails as $em)
                                                <p><a href="mailto:{{ trim($em, '"') }}">{{ trim($em, '"') }}</a></p>
                                            @endforeach
                                        @else
                                            <p><a href="mailto:info@neconvalves.com">info@neconvalves.com</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                                <div class="office-info-item">
                                    <div class="office-info-icon">
                                        <div class="icon">
                                            @if (!empty($phoneImg))
                                                <img src="{{ asset('ContactImage/' . $phoneImg) }}" alt="phone icon"
                                                    style="max-width:48px;">
                                            @else
                                                <i class="fi flaticon-phone-call"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="office-info-text">
                                        <h2>Call Now</h2>

                                        @if (!empty($phones))
                                            @foreach ($phones as $ph)
                                                @php
                                                    $clean = preg_replace('/[^\d\+]/', '', $ph);
                                                @endphp
                                                <p><a href="tel:{{ $clean }}">{{ $ph }}</a></p>
                                            @endforeach
                                        @else
                                            <p><a href="tel:+919825530462">+91 98255 30462</a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wpo-contact-form-area">
                        <form method="POST" action="{{ route('enquiryCreate') }}" class="contact-form-main" novalidate>
                            @csrf
                            <div><input type="text" class="form-control mb-3" name="name" placeholder="Your Name*" required></div>
                            <div><input type="email" class="form-control mb-3" name="email" placeholder="Your Email*" required></div>
                            <div><input type="text" class="form-control mb-3" name="address" placeholder="Address"></div>
                            <div><input type="text" class="form-control mb-3" name="company" placeholder="Company"></div>
                            <div class="fullwidth mb-3"><textarea class="form-control" name="message" placeholder="Message..."></textarea></div>
                            <div class="submit-area">
                                <button type="submit" class="theme-btn w-100">Get in Touch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="wpo-contact-map-section">
        <h2 class="hidden">Contact map</h2>
        <div class="wpo-contact-map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.858340361754!2d72.69056557531404!3d23.02897297916926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e87b9b64a42bb%3A0xd0bfe6f2a3f9b753!2sShreenath%20engineering!5e0!3m2!1sen!2sin!4v1720422620209!5m2!1sen!2sin"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    <!-- Custom Toast Notification -->
    <div id="custom-toast" class="custom-toast">
        <div class="toast-content">
            <i class="fas fa-check-circle toast-icon success-icon"></i>
            <i class="fas fa-exclamation-circle toast-icon error-icon"></i>
            <i class="fas fa-spinner fa-spin toast-icon loading-icon"></i>
            <div class="message">
                <span class="text text-1"></span>
                <span class="text text-2"></span>
            </div>
        </div>
        <div class="progress"></div>
    </div>

    <style>
        /* Custom Toast Styles */
        .custom-toast {
            position: fixed;
            top: 25px;
            right: 30px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-left: 5px solid #2ecc71;
            overflow: hidden;
            transform: translateX(calc(100% + 30px));
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
            z-index: 9999;
            max-width: 400px;
            opacity: 0;
        }

        .custom-toast.active {
            transform: translateX(0%);
            opacity: 1;
        }

        .custom-toast.error {
            border-left-color: #e74c3c;
        }

        .custom-toast.loading {
            border-left-color: #3498db;
        }

        .toast-content {
            display: flex;
            align-items: center;
        }

        .toast-icon {
            font-size: 28px;
            margin-right: 15px;
            display: none;
        }

        .success-icon {
            color: #2ecc71;
        }

        .error-icon {
            color: #e74c3c;
        }

        .loading-icon {
            color: #3498db;
        }

        .message .text {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .message .text.text-1 {
            font-weight: 600;
            color: #2c3e50;
        }

        .message .text.text-2 {
            font-size: 14px;
            color: #666;
            margin-top: 3px;
            display: block;
        }

        .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: #ddd;
        }

        .progress:before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background: #2ecc71;
        }

        .error .progress:before {
            background: #e74c3c;
        }

        .loading .progress:before {
            background: #3498db;
            animation: progress 5s linear forwards;
        }

        @keyframes progress {
            100% {
                right: 100%;
            }
        }

        @media (max-width: 576px) {
            .custom-toast {
                right: 15px;
                left: 15px;
                max-width: none;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector(".contact-form-main");
            const toast = document.getElementById("custom-toast");
            const successIcon = toast.querySelector(".success-icon");
            const errorIcon = toast.querySelector(".error-icon");
            const loadingIcon = toast.querySelector(".loading-icon");
            const text1 = toast.querySelector(".text-1");
            const text2 = toast.querySelector(".text-2");
            const progress = toast.querySelector(".progress");

            function showToast(status, message1, message2 = "") {
                // Reset all icons
                successIcon.style.display = "none";
                errorIcon.style.display = "none";
                loadingIcon.style.display = "none";
                
                // Remove all status classes
                toast.classList.remove("active", "success", "error", "loading");
                
                // Set content based on status
                text1.textContent = message1;
                text2.textContent = message2;
                
                // Show appropriate icon and set class
                if (status === "success") {
                    successIcon.style.display = "block";
                    toast.classList.add("success");
                } else if (status === "error") {
                    errorIcon.style.display = "block";
                    toast.classList.add("error");
                } else if (status === "loading") {
                    loadingIcon.style.display = "block";
                    toast.classList.add("loading");
                }
                
                // Show toast
                toast.classList.add("active");
                
                // Auto hide after 5 seconds for success/error, but not for loading
                if (status !== "loading") {
                    setTimeout(() => {
                        toast.classList.remove("active");
                    }, 5000);
                }
            }

            form.addEventListener("submit", function(e) {
                e.preventDefault();
                
                // Show loading toast
                showToast("loading", "Message is being sent...", "Please wait a moment");
                
                fetch("{{ route('enquiryCreate') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: new URLSearchParams(new FormData(form))
                })
                .then(res => {
                    if (res.ok) {
                        // Show success toast
                        showToast("success", "Your enquiry was created successfully!", "We'll get back to you soon");
                        form.reset();
                    } else {
                        // Show error toast
                        showToast("error", "Something went wrong!", "Please try again later");
                    }
                })
                .catch(() => {
                    // Show error toast
                    showToast("error", "Something went wrong!", "Please try again later");
                });
            });
        });
    </script>
@endsection