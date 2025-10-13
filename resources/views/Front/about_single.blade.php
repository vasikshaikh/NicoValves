@extends('Front.Layout.main')

@section('main-container')

<section class="page-banner" style="background-image: url('{{ asset('front_assets/assets/images/about-banner.jpg') }}');">
    <div class="container">
        <div class="page-banner-tilte">
            <h2 style="color:#ffffff; font-size:36px; font-weight:700; text-shadow: 2px 2px 6px rgba(0,0,0,0.3);">
                {{ $section->title }}
            </h2>
        </div>
    </div>
</section>

<section class="about-us">
    <div class="container" style="margin-top:50px;">
        <div class="disc" style="font-size:16px; line-height:1.8; color:#333333; margin-bottom:30px;">
            {!! $section->description !!}
        </div>

        @if (!empty($section->image))
            @php
                $images = is_array($section->image) ? $section->image : json_decode($section->image, true);
            @endphp

            <div class="images" style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">
                @foreach($images as $img)
                    <div style="overflow:hidden; width:220px; height:160px; border-radius:12px; box-shadow:0 8px 16px rgba(0,0,0,0.2); border:2px solid #2073c6; transition: all 0.4s ease; cursor:pointer;">
                        <img 
                            src="{{ asset('AboutImage/' . $img) }}" 
                            alt="{{ $section->title }}"
                            style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s, border-color 0.4s;"
                            onmouseover="this.style.transform='scale(1.2)'; this.parentElement.style.borderColor='#003c95';"
                            onmouseout="this.style.transform='scale(1)'; this.parentElement.style.borderColor='#2073c6';"
                        >
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
