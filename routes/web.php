<?php

use Illuminate\Support\Facades\Route;

// Catalog
use App\Http\Controllers\Catalog\HomeController;
use App\Http\Controllers\Catalog\Product\ProductController;
use App\Http\Controllers\Catalog\Product\CategoryController;

//admin
use App\Http\Controllers\Admin\Common\AdminLoginController;
use App\Http\Controllers\Admin\Common\AdminDashboardController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\EcommerceLinkController;
use App\Http\Controllers\Admin\Design\BannerController;
use App\Http\Controllers\admin\AdminDemoDataTableController;
use App\Http\Controllers\Admin\Design\AdminMediaController;
use App\Http\Controllers\Admin\Setting\SiteController;
use App\Http\Controllers\Admin\Storefront\AdminProductController;
use App\Http\Controllers\Admin\Storefront\AdminCategoryController;
use App\Http\Controllers\Admin\Storefront\ColorController;
use App\Http\Controllers\Admin\Storefront\SizeController;

// Catalog
Route::name('catalog.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/{product_id}/{slug?}', [ProductController::class, 'productDetail'])->name('product-detail');
    Route::get('/category/{category_id?}/{category_slug?}', [CategoryController::class, 'index'])->name('category');
});

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

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin/setting')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('admin-setting');
    Route::get('/ecommerce-links', [EcommerceLinkController::class, 'index'])->name('ecommerce-links');
    Route::post('/ecommerce-links-save', [EcommerceLinkController::class, 'save'])->name('ecommerce-links-save');
    Route::get('/site', [SiteController::class, 'index'])->name('site');
    Route::post('/site-save', [SiteController::class, 'save'])->name('site-save');
});

Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::post('/admin/banner', [BannerController::class, 'saveBanner'])->name('admin-banner')->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/getallbanner', [BannerController::class, 'getBanner'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/{banner_id}', [BannerController::class, 'getBannerById'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/banner/delete/{banner_id}', [BannerController::class, 'deleteBanner'])->middleware('AdminMiddlewareLogin');

Route::get('/admin/admin-demo-data-table', [AdminDemoDataTableController::class, 'index'])->name('admin-demo-data-table')->middleware('AdminMiddlewareLogin');

Route::middleware(['AdminMiddlewareLogin'])->prefix('admin/storefront')->group(function () {
    Route::get('product', [AdminProductController::class, 'index'])->name('admin-storefront-product');
    Route::get('product-form', [AdminProductController::class, 'form']);
    Route::post('product-save', [AdminProductController::class, 'save'])->name('admin-product-save');
    Route::get('product-edit/product_id={product_id}', [AdminProductController::class, 'editProduct'])->name("admin-product-edit");
    Route::post('product-update/product_id={product_id}', [AdminProductController::class, 'updateProduct'])->name("admin-product-update");
    Route::get('product-delete/product_id={product_id}', [AdminProductController::class, 'delete'])->name('admin-product-delete');
    
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
    Route::post('color-delete/color_id={color_id}',[ColorController::class, 'delete'])->name('delete-color');

    Route::get('size/', [SizeController::class, 'index'])->name('size');
    Route::get('size-form',[SizeController::class, 'form']);
    Route::post('size-save',[SizeController::class, 'save'])->name('save-size');
    Route::get('size-edit/size_id={size_id}',[SizeController::class, 'edit'])->name('edit-size');
    Route::post('size-update/size_id={size_id}',[SizeController::class, 'update'])->name('update-size');
    Route::post('size-delete/size_id={size_id}',[SizeController::class, 'delete'])->name('delete-size');
});

Route::get('/admin/media', [AdminMediaController::class, 'index'])->name('admin-media')->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/uploadFile', [AdminMediaController::class, 'uploadFile'])->middleware('AdminMiddlewareLogin');
Route::get('/admin/media/getFiles', [AdminMediaController::class, 'getFiles'])->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/createFolder', [AdminMediaController::class, 'createFolder'])->middleware('AdminMiddlewareLogin');
Route::post('/admin/media/delete', [AdminMediaController::class, 'delete'])->middleware('AdminMiddlewareLogin');