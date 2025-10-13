<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChooseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

///// Public Purpose /////
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'login'])->name('login');

///// Middleware authenticvation are access Routes /////
Route::group(['middleware' => 'is_admin'], function () {

    ///// Admin Page Purpose /////
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile/{id}', [AdminController::class, 'getAdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/{id}', [AdminController::class, 'updateAdminProfile'])->name('admin.profile.update');
    Route::post('/logout_admin', [AdminController::class, 'logout'])->name('admin.logout');

    ///// Home Slider Purpose /////
    Route::prefix('slider')->controller(SliderController::class)->group(function () {
        Route::get('/add', 'addSlider')->name('addSlider');
        Route::post('/save', 'saveSlider')->name('saveSlider');
        Route::get('/list', 'listSlider')->name('listSlider');
        Route::get('/edit/{id}', 'editSlider')->name('editSlider');
        Route::post('/update/{id}', 'updateSlider')->name('updateSlider');
        Route::get('/delete/{id}', 'deleteSlider')->name('deleteSlider');
    });

    ///// Home About Purpose /////
    Route::prefix('about')->controller(AboutController::class)->group(function () {
        Route::get('/add', 'addAbout')->name('addAbout');
        Route::post('/save', 'saveAbout')->name('saveAbout');
        Route::get('/list', 'listAbout')->name('listAbout');
        Route::get('/edit/{id}', 'editAbout')->name('editAbout');
        Route::post('/update/{id}', 'updateAbout')->name('updateAbout');
        Route::get('/delete/{id}', 'deleteAbout')->name('deleteAbout');
    });

    ///// Home Goal Purpose /////
    Route::prefix('goal')->controller(GoalController::class)->group(function () {
        Route::get('/add', 'addGoal')->name('addGoal');
        Route::post('/save', 'saveGoal')->name('saveGoal');
        Route::get('/list', 'listGoal')->name('listGoal');
        Route::get('/edit/{id}', 'editGoal')->name('editGoal');
        Route::post('/update/{id}', 'updateGoal')->name('updateGoal');
        Route::get('/delete/{id}', 'deleteGoal')->name('deleteGoal');
    });

    /////  Category Purpose /////
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/add', 'addCategory')->name('addCategory');
        Route::get('/search', 'searchCategory')->name('searchCategory');
        Route::post('/save', 'saveCategory')->name('saveCategory');
        Route::get('/list', 'listCategory')->name('listCategory');
        Route::get('/edit/{id}', 'editCategory')->name('editCategory');
        Route::post('/update/{id}', 'updateCategory')->name('updateCategory');
        Route::get('/delete/{id}', 'deleteCategory')->name('deleteCategory');
    });

    /////  Product Purpose /////
    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/add', 'addProduct')->name('addProduct');
        Route::post('/save', 'saveProduct')->name('saveProduct');
        Route::get('/list', 'listProduct')->name('listProduct');
        Route::get('/edit/{id}', 'editProduct')->name('editProduct');
        Route::post('/update/{id}', 'updateProduct')->name('updateProduct');
        Route::get('/delete/{id}', 'deleteProduct')->name('deleteProduct');
    });

    /////  ChooseUs Purpose /////
    Route::prefix('choose')->controller(ChooseController::class)->group(function () {
        Route::get('/add', 'addChoose')->name('addChoose');
        Route::post('/save', 'saveChoose')->name('saveChoose');
        Route::get('/list', 'listChoose')->name('listChoose');
        Route::get('/edit/{id}', 'editChoose')->name('editChoose');
        Route::post('/update/{id}', 'updateChoose')->name('updateChoose');
        Route::get('/delete/{id}', 'deleteChoose')->name('deleteChoose');
    });

    /////  Choose Us Purpose /////
    Route::prefix('achievement')->controller(AchievementController::class)->group(function () {
        Route::get('/add', 'addAchievement')->name('addAchievement');
        Route::post('/save', 'saveAchievement')->name('saveAchievement');
        Route::get('/list', 'listAchievement')->name('listAchievement');
        Route::get('/edit/{id}', 'editAchievement')->name('editAchievement');
        Route::post('/update/{id}', 'updateAchievement')->name('updateAchievement');
        Route::get('/delete/{id}', 'deleteAchievement')->name('deleteAchievement');
    });

    /////  About Us Purpose /////
    Route::prefix('aboutus')->controller(AboutUsController::class)->group(function () {
        Route::get('/add', 'addAboutUs')->name('addAboutUs');
        Route::post('/save', 'saveAboutUs')->name('saveAboutUs');
        Route::get('/list', 'listAboutUs')->name('listAboutUs');
        Route::get('/edit/{id}', 'editAboutUs')->name('editAboutUs');
        Route::post('/update/{id}', 'updateAboutUs')->name('updateAboutUs');
        Route::get('/delete/{id}', 'deleteAboutUs')->name('deleteAboutUs');
    });

    /////  Quality Purpose /////
    Route::prefix('quality')->controller(QualityController::class)->group(function () {
        Route::get('/add', 'addQuality')->name('addQuality');
        Route::post('/save', 'saveQuality')->name('saveQuality');
        Route::get('/list', 'listQuality')->name('listQuality');
        Route::get('/edit/{id}', 'editQuality')->name('editQuality');
        Route::post('/update/{id}', 'updateQuality')->name('updateQuality');
        Route::get('/delete/{id}', 'deleteQuality')->name('deleteQuality');
    });

    /////  Contact Purpose /////
    Route::prefix('contact')->controller(ContactController::class)->group(function () {
        Route::get('/add', 'addContact')->name('addContact');
        Route::post('/save', 'saveContact')->name('saveContact');
        Route::get('/list', 'listContact')->name('listContact');
        Route::get('/edit/{id}', 'editContact')->name('editContact');
        Route::post('/update/{id}', 'updateContact')->name('updateContact');
        Route::get('/delete/{id}', 'deleteContact')->name('deleteContact');


        // Enquiry List
        Route::get('/enquiry/list', 'listEnquiry')->name('listEnquiry');  
    });
});

///// Frontend Purpose /////
Route::get('/', [FrontController::class, 'website'])->name('homeWebsite');
Route::get('/about', [FrontController::class, 'aboutWebsite'])->name('aboutWebsite');
Route::get('/about/{id}', [FrontController::class, 'aboutWebsiteById'])->name('aboutWebsiteById');
Route::get('/list/category', [FrontController::class, 'websiteCategoryList'])->name('websiteCategoryList');
Route::get('/list/category/{id}', [FrontController::class, 'websiteCategoryList'])->name('websiteCategoryList.id');
Route::get('/product/details/{id}', [FrontController::class, 'productDetails'])->name('productDetails');
Route::get('/quality', [FrontController::class, 'qualityWebsite'])->name('qualityWebsite');
Route::get('/contact', [FrontController::class, 'contactWebsite'])->name('contactWebsite');
Route::post('/enquiry/create', [FrontController::class, 'enquiryCreate'])->name('enquiryCreate');
