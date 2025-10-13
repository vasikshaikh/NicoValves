@extends('Front.Layout.main')

@section('main-container')

<section class="page-banner" style="background-image: url('{{ asset('front_assets/assets/images/about-banner.jpg') }}');">
    <div class="container">
        <div class="page-banner-tilte">
            <h2>About Us</h2>
        </div>
    </div>
</section>

<section class="about-us">
    <div class="container">
        @foreach ($about_us_data as $section)
            <div style="margin-bottom: 40px;">
                <h2>
                    <a href="{{ route('aboutWebsiteById', $section->id) }}">
                        {{ $section->title }}
                    </a>
                </h2>
                <div class="disc">
                    {!! Str::limit(strip_tags($section->description), 200) !!}...
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection
