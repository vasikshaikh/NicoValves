<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryMail;
use App\Models\AboutInfo;
use App\Models\AboutUsInfo;
use App\Models\AchievementInfo;
use App\Models\CategoryInfo;
use App\Models\ChooseInfo;
use App\Models\ContactInfo;
use App\Models\EnquiryInfo;
use App\Models\GoalInfo;
use App\Models\ProductInfo;
use App\Models\QualityInfo;
use App\Models\SliderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function website()
    {
        $slider_data = SliderInfo::latest()->get();
        $about_data = AboutInfo::latest()->first();
        $goal_data = GoalInfo::latest()->get();
        // $product_data = ProductInfo::latest()->get();
        $product_data = ProductInfo::latest()->take(5)->get();
        $choose_data = ChooseInfo::all();
        $achievement_data = AchievementInfo::all();
        $about_us_data = AboutUsInfo::all();
        return view('Front.index', compact(
            'slider_data',
            'about_data',
            'goal_data',
            'product_data',
            'choose_data',
            'achievement_data',
            'about_us_data'
        ));
    }

    public function aboutWebsite()
    {
        $about_us_data = AboutUsInfo::all();
        return view('Front.about', compact('about_us_data'));
    }

    public function aboutWebsiteById($id)
    {
        $section = AboutUsInfo::findOrFail($id);
        return view('Front.about_single', compact('section'));
    }
    public function websiteCategoryList($id = null)
    {
        // Get all categories for tabs
        $categories = CategoryInfo::all();

        // If category ID is provided, get products of that category
        if ($id) {
            $selectedCategory = CategoryInfo::find($id);

            if (!$selectedCategory) {
                abort(404, 'Category not found');
            }

            // Get products directly by category_id
            $categoryProducts = ProductInfo::where('category_id', $id)->get();
        } else {
            $selectedCategory = null;
            $categoryProducts = collect(); // Empty collection
        }

        // Get all products for "All" tab
        $allProducts = ProductInfo::with('category')->get();

        return view('Front.category_list', compact('categories', 'selectedCategory', 'allProducts', 'categoryProducts'));
    }

public function productDetails($id)
{
    // Product ko find karein with category relationship
    $product = ProductInfo::with('category')->find($id);

    if (!$product) {
        abort(404, 'Product not found');
    }

    // Related products - agar category hai toh same category ke, nahi toh random
    if ($product->category_id) {
        $relatedProducts = ProductInfo::where('category_id', $product->category_id)
                                      ->where('id', '!=', $id)
                                      ->limit(6)
                                      ->get();
    } else {
        // Agar category nahi hai toh random products
        $relatedProducts = ProductInfo::where('id', '!=', $id)
                                      ->inRandomOrder()
                                      ->limit(6)
                                      ->get();
    }

    return view('Front.product_detail', compact('product', 'relatedProducts'));
}


    public function qualityWebsite()
    {
        $quality = QualityInfo::first();
        // dd($quality);
        return view('Front.quality', compact('quality'));
    }

    public function contactWebsite()
    {
        $contact_data = ContactInfo::first();
        // dd($contact_data);
        return view('Front.contact', compact('contact_data'));
    }

  public function enquiryCreate(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'address' => 'nullable|string|max:255',
        'company' => 'nullable|string|max:150',
        'message' => 'nullable|string',
    ]);

    // Save to DB
    $enquiry = EnquiryInfo::create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'company' => $request->company,
        'message' => $request->message,
    ]);

    // Send Mail
    Mail::to('info@neconvalves.com')->send(new EnquiryMail($enquiry));

    return redirect()->back()->with('success', 'Enquiry submitted successfully!');
}
}
