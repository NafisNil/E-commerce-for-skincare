<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SkintypeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ShopController;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/shop-index', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop-product/{slug}', [ShopController::class, 'product_details'])->name('shop.details');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function(){
    Route::get('account-dashboard', [UserController::class, 'index'])->name('user.index');
});
Route::middleware(['auth','admin'])->group(function(){
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resources([
        'brands' => BrandController::class,
        'category' => CategoryController::class,
        'subCategory' => SubCategoryController::class,
        'products' => ProductController::class,
        'skintype' => SkintypeController::class,
        'blog' => BlogController::class
    ]);
    Route::get('all-user',[AdminController::class, 'all_user'])->name('all_user');
    Route::delete('user-delete/{user}', [AdminController::class, 'delete_user'])->name('user.destroy');
});
