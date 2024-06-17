<?php

use Illuminate\Support\Facades\Route;

// Catalog
use App\Http\Controllers\Catalog\HomeController;
use App\Http\Controllers\Catalog\Product\ProductController;

//admin
use App\Http\Controllers\Admin\Common\AdminLoginController;
use App\Http\Controllers\Admin\Common\AdminDashboardController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Design\BannerController;
use App\Http\Controllers\admin\AdminDemoDataTableController;
use App\Http\Controllers\Admin\Design\AdminMediaController;
use App\Http\Controllers\Admin\Storefront\AdminProductController;


// Catalog
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');

// Admin
Route::get('/admin', function () {
    return redirect()->route('admin-login');
});
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin-login')->middleware('AdminMiddlewareLogout');
Route::post('/admin/login', [AdminLoginController::class, 'AdminLogin'])->name('admin-login')->middleware('AdminMiddlewareLogout');
Route::post('/admin/logout', [AdminLoginController::class, 'adminLogout'])->name('admin-logout');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard')->middleware('AdminMiddlewareLogin');

Route::get('/admin/contact-us', [AdminContactController::class, 'index'])->name('admin-contact')->middleware('AdminMiddlewareLogin');
Route::post('/admin/contact-us', [AdminContactController::class, 'saveContact'])->name('admin-contact')->middleware('AdminMiddlewareLogin');

Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin-setting')->middleware('AdminMiddlewareLogin');
Route::post('/admin/setting', [SettingController::class, 'saveSetting'])->name('admin-setting')->middleware('AdminMiddlewareLogin');

Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::post('/admin/banner', [BannerController::class, 'saveBanner'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/getallbanner', [BannerController::class, 'getBanner'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/{banner_id}', [BannerController::class, 'getBannerById'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/delete/{banner_id}', [BannerController::class, 'deleteBanner'])->middleware('AdminMiddlewareLogin');

Route::get('/admin/admin-demo-data-table', [AdminDemoDataTableController::class, 'index'])->name('admin-demo-data-table')->middleware('AdminMiddlewareLogin');

Route::get('/admin/storefront/product', [AdminProductController::class, 'index'])->name('admin-storefront-product')->middleware('AdminMiddlewareLogin');
Route::get('/admin/storefront/product-form', [AdminProductController::class, 'form'])->middleware('AdminMiddlewareLogin');

Route::get('/admin/media', [AdminMediaController::class, 'index'])->name('admin-media')->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/uploadFile', [AdminMediaController::class, 'uploadFile'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/media/getFiles', [AdminMediaController::class, 'getFiles'])->middleware('AdminMiddlewareLogin');