<?php

namespace App\Providers;

use App\Models\AboutUsInfo;
use App\Models\ProductInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Make $about_us_data available in all views
        View::share('about_us_data', AboutUsInfo::orderBy('id')->get());

        // Latest 5 Products for footer
        $latest_products = ProductInfo::latest()->take(5)->get();
        View::share('latest_products', $latest_products);
    }
}
