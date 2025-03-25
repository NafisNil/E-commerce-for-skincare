<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
Route::get('/', [FrontendController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function(){
    Route::get('account-dashboard', [UserController::class, 'index'])->name('user.index');
});
Route::middleware(['auth','admin'])->group(function(){
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
});
