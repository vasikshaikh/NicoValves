@extends('Front.Layout.main')

@section('main-container')

  <section class="page-banner" style="background-image: url('{{ asset('front_assets/assets/images/about-banner.jpg') }}');">
            <div class="container">
                <div class="page-banner-tilte">
                    <h2>Quality</h2>
                </div>
            </div>
        </section>

        {{-- <section class="quality-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="quality-page-content">
                            <h2>We always aim to deliver the best quality work.</h2>
                            <p>At Shreenath Engineering, every valve is made and tested to meet international standards, ensuring top-notch quality for customer satisfaction.</p>

                            <p>It sounds like Shreenath Engineering has implemented a comprehensive quality assurance system to ensure the precision and reliability of its products. Here are some key points highlighted from your description:</p>

                            <div class="qaulity-text">
                                <ul>
                                    <li><p><span>Production Process and Testing Procedures:</span> Each valve undergoes a rigorous production process followed by stringent testing procedures.</p></li>

                                    <li><p><span>Attention to Detail:</span> The Quality Assurance team ensures that every detail is meticulously checked throughout the entire production cycle.</p></li>
                                    <li><p><span>High-Tech Equipment:</span> The team is equipped with advanced pressure testing rigs and a variety of measuring instruments such as digital vernier calipers, micrometers, dial gauges, height gauges, torque wrenches, thread gauges, and radius gauges.</p></li>
                                    <li><p><span>Proficiency and Accuracy:</span> All activities at Shreenath Engineering are conducted with high levels of proficiency and accuracy to maintain product quality.</p></li>
                                    <li><p><span>Compliance with Standards:</span> Registration with the Bureau of Indian Standard (BIS) and adherence to its norms have further enhanced the quality assurance plan and system at Shreenath Engineering.</p></li>

                                </ul>
                            </div>

                            <p>This systematic approach to quality assurance underscores Shreenath Engineering' commitment to delivering high-quality valves that meet industry standards and customer expectations.</p>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="quality-img">
                           <img src="{{ asset('front_assets/assets/images/quality-img.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

       <section class="quality-page">
    <div class="container">
        <div class="row align-items-center">
            {{-- Left Side: Dynamic Content --}}
            <div class="col-lg-6">
                <div class="quality-page-content">
                    @if(!empty($quality))
                        <h2>{{ $quality->title }}</h2>
                        {!! $quality->description !!}
                    @else
                        <h2>No Quality Data Found</h2>
                    @endif
                </div>
            </div>

            {{-- Right Side: Dynamic Images --}}
            <div class="col-lg-6">
                <div class="quality-img">
                    @php
                        $imgs = [];
                        if (!empty($quality) && !empty($quality->image)) {
                            if (is_array($quality->image)) {
                                $imgs = $quality->image;
                            } else {
                                $decoded = json_decode($quality->image, true);
                                if (is_array($decoded)) {
                                    $imgs = $decoded;
                                } else {
                                    $possible = preg_replace('/[\[\]\"]/', '', $quality->image);
                                    $parts = array_filter(array_map('trim', explode(',', $possible)));
                                    if (!empty($parts)) {
                                        $imgs = array_values($parts);
                                    }
                                }
                            }
                        }
                    @endphp

                    @if(!empty($imgs))
                        @foreach($imgs as $image)
                            <div class="mb-3">
                                <img src="{{ asset('QualityImage/' . $image) }}"
                                     alt="{{ $quality->title }}"
                                     style="width:100%; height:auto; border-radius:8px; object-fit:cover;">
                            </div>
                        @endforeach
                    @else
                        <img src="{{ asset('front_assets/assets/images/quality-img.png') }}" alt="Quality image">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
