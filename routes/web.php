<?php

use Illuminate\Support\Facades\Route;

// Catalog
use App\Http\Controllers\Catalog\HomeController;
use App\Http\Controllers\Catalog\Product\ProductController;
use App\Http\Controllers\Catalog\Product\CategoryController;
use App\Http\Controllers\Catalog\Account\AccountController;

//admin
use App\Http\Controllers\Admin\Common\AdminLoginController;
use App\Http\Controllers\Admin\Common\AdminDashboardController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\EcommerceLinkController;
use App\Http\Controllers\Admin\Design\BannerController;
use App\Http\Controllers\Admin\Common\ProfileController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Design\AdminMediaController;
use App\Http\Controllers\Admin\Setting\ApiController;
use App\Http\Controllers\Admin\Setting\SiteController;
use App\Http\Controllers\Admin\Storefront\AdminProductController;
use App\Http\Controllers\Admin\Storefront\AdminCategoryController;
use App\Http\Controllers\Admin\Storefront\ColorController;
use App\Http\Controllers\Admin\Storefront\SizeController;
use App\Http\Controllers\Catalog\Account\DashboardController;
use App\Http\Controllers\Catalog\Account\ProfileController as AccountProfileController;

// Catalog
Route::name('catalog.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/{product_id}/{slug?}', [ProductController::class, 'productDetail'])->name('product-detail');
    Route::get('/products/{category_id?}/{category_slug?}', [ProductController::class, 'getAllProduct'])->name('product-all');
    Route::get('/category', [CategoryController::class, 'getAllCategories'])->name('getAllCategories');

    Route::get('/account', function () {
        return redirect()->route('catalog.user-login');
    });

    Route::middleware('CatalogMiddlewareLogout')->group(function (){
        Route::prefix('account')->group(function (){
            Route::get('/login', [AccountController::class, 'index'])->name('user-login');
            Route::post('/login', [AccountController::class, 'login'])->name('user-login-account');
            Route::post('/register', [AccountController::class, 'register'])->name('user-register');
            Route::get('/verify-otp', [AccountController::class, 'verifyOtpPage'])->name('verifyOtpPage');
            Route::post('/verify-otp', [AccountController::class, 'verifyOTP'])->name('verifyOTP');
        });
    });
    
    Route::middleware('CatalogMiddlewareLogin')->group(function () {
        Route::get('/account/logout', [AccountController::class, 'logout'])->name('logout');

        Route::prefix('account')->group(function (){ 
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('front-user-dashboard');
            Route::get('/profile', [AccountProfileController::class, 'index'])->name('profile');
            Route::post('/profile', [AccountProfileController::class, 'update'])->name('update-profile');
            Route::get('/change-password', [AccountProfileController::class, 'viewChangePassword'])->name('viewChangePassword');
            Route::post('/change-password', [AccountProfileController::class, 'changePassword'])->name('changePassword');
        });
    });

});

// Admin
Route::get('/admin', function () {
    return redirect()->route('admin-login');
});
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin-login')->middleware('AdminMiddlewareLogout');
Route::post('/admin/login', [AdminLoginController::class, 'AdminLogin'])->name('admin-login')->middleware('AdminMiddlewareLogout');
Route::post('/admin/logout', [AdminLoginController::class, 'adminLogout'])->name('admin-logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard')->middleware('AdminMiddlewareLogin');

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin/setting')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('admin-setting');
    Route::get('/ecommerce-links', [EcommerceLinkController::class, 'index'])->name('ecommerce-links');
    Route::post('/ecommerce-links-save', [EcommerceLinkController::class, 'save'])->name('ecommerce-links-save');
    Route::get('/site', [SiteController::class, 'index'])->name('site');
    Route::post('/site-save', [SiteController::class, 'save'])->name('site-save');
    Route::get('/api', [ApiController::class, 'index'])->name('api');
    Route::post('/api-save', [ApiController::class, 'save'])->name('api-save');
});

Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::post('/admin/banner', [BannerController::class, 'saveBanner'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/getallbanner', [BannerController::class, 'getBanner'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/{banner_id}', [BannerController::class, 'getBannerById'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/delete/{banner_id}', [BannerController::class, 'deleteBanner'])->middleware('AdminMiddlewareLogin');

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin/storefront')->group(function () {
    Route::get('product', [AdminProductController::class, 'index'])->name('admin-storefront-product');
    Route::get('product-form', [AdminProductController::class, 'form']);
    Route::post('product-save', [AdminProductController::class, 'save'])->name('admin-product-save');
    Route::get('product-edit/product_id={product_id}', [AdminProductController::class, 'editProduct'])->name("admin-product-edit");
    Route::post('product-update/product_id={product_id}', [AdminProductController::class, 'updateProduct'])->name("admin-product-update");
    Route::get('product-delete/product_id={product_id}', [AdminProductController::class, 'delete'])->name('admin-product-delete');
    Route::post('product-variation/', [AdminProductController::class, 'addVariation'])->name('admin-addVariation');
    Route::get('product-get-variation/{product_id}', [AdminProductController::class, 'getVariation'])->name('admin-getVariation');
    Route::post('deleteMultiSelection/', [AdminProductController::class, 'deleteMultiSelection']);
    
    Route::get('category/', [AdminCategoryController::class, 'index'])->name('category');
    Route::get('category-form/', [AdminCategoryController::class, 'form']);
    Route::post('category-save/', [AdminCategoryController::class, 'save'])->name('save-category');
    Route::get('category-edit/category_id={category_id}', [AdminCategoryController::class, 'edit'])->name('edit-category');
    Route::post('category-update/category_id={category_id}', [AdminCategoryController::class, 'update'])->name('update-category');
    Route::get('category-delete/category_id={category_id}', [AdminCategoryController::class, 'delete'])->name('delete-category');

    Route::get('color/', [ColorController::class, 'index'])->name('colors');
    Route::get('color-form',[ColorController::class, 'form']);
    Route::post('color-save',[ColorController::class, 'save'])->name('save-color');
    Route::get('color-edit/color_id={color_id}',[ColorController::class, 'edit'])->name('edit-color');
    Route::post('color-update/color_id={color_id}',[ColorController::class, 'update'])->name('update-color');
    Route::get('color-delete/color_id={color_id}',[ColorController::class, 'delete'])->name('delete-color');

    Route::get('size/', [SizeController::class, 'index'])->name('size');
    Route::get('size-form',[SizeController::class, 'form']);
    Route::post('size-save',[SizeController::class, 'save'])->name('save-size');
    Route::get('size-edit/size_id={size_id}',[SizeController::class, 'edit'])->name('edit-size');
    Route::post('size-update/size_id={size_id}',[SizeController::class, 'update'])->name('update-size');
    Route::get('size-delete/size_id={size_id}',[SizeController::class, 'delete'])->name('delete-size');
});

Route::get('/admin/media', [AdminMediaController::class, 'index'])->name('admin-media')->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/uploadFile', [AdminMediaController::class, 'uploadFile'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/media/getFiles', [AdminMediaController::class, 'getFiles'])->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/createFolder', [AdminMediaController::class, 'createFolder'])->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/delete', [AdminMediaController::class, 'delete'])->middleware('AdminMiddlewareLogin');

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin/customer')->group(function () {
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('customer-form', [CustomerController::class, 'form'])->name('customer-form');
    Route::get('customer-edit/customer_id={customer_id}', [CustomerController::class, 'edit'])->name('customer-edit');
    Route::post('customer-save/{customer_id?}', [CustomerController::class, 'save'])->name('customer-save');
    Route::get('customer-delete/{customer_id}', [CustomerController::class, 'delete'])->name('customer-delete');
    Route::post('deleteMultiSelection/', [CustomerController::class, 'deleteMultiSelection']);
});

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin')->group(function(){
    Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::post('save-profile', [ProfileController::class, 'saveProfile'])->name('save-profile');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('save-password', [ProfileController::class, 'savePassword'])->name('save-password');
});