<?php

namespace App\Http\Controllers;

use App\Models\CategoryInfo;
use App\Models\Centersection;
use App\Models\Childrensection;
use App\Models\CustomerInfo;
use App\Models\EnquiryInfo;
use App\Models\OrderInfo;
use App\Models\PlanInfo;
use App\Models\ProductInfo;
use App\Models\SubscriptionInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.login');
    }

    public function login(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($validator->passes());
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                // dd(Auth::guard('admin')->user());
                if (Auth::guard('admin')->user()->role != "admin") {
                    return redirect()->route('login')->with('error', 'Enter valid email or password...');
                }
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            } else {
                return redirect()->route('login')->with('error', 'Enter valid email or password...');
            }
        } else {
            return redirect()->route('login')->with('error', 'Enter valid email or password...');
        }
    }

    public function dashboard()
    {
        // Ensure only authenticated admins can access the dashboard
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $category_count = CategoryInfo::count();
        // dd($category_count);

        $product_count = ProductInfo::count();
        // dd($product_count);

        $enquiry_count = EnquiryInfo::count();
        // dd($enquiry_count);

        return view('Admin.index', compact('category_count', 'product_count', 'enquiry_count'));
    }


    public function getAdminProfile($id)
    {
        $authenticatedAdmin = Auth::guard('admin')->user();

        if (!$authenticatedAdmin) {
            abort(404, 'Admin not found.');
        }

        if ($authenticatedAdmin->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        $admin = User::findOrFail($id);
        // dd($admin);

        return view('Admin.profile', compact('admin'));
    }

    public function updateAdminProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|confirmed',
            'phone' => 'nullable|string|max:20',
        ], [
            'password.confirmed' => 'The password and confirm password does not match.',
        ]);

        $admin = User::findOrFail($id);

        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->phone = $validatedData['phone'];

        if (!empty($validatedData['password'])) {
            $admin->password = Hash::make($validatedData['password']);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Admin details updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
