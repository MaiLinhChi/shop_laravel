<?php

use App\Http\Controllers\Admin\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AccountController::class, 'index'])->name('');
Route::post('/login', [AccountController::class, 'authenticate'])->name('login');


Route::prefix('admin')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });

    Route::prefix('slider')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.slider');
        Route::get('/create', [SliderController::class, 'create'])->name('admin.slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('admin.slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('admin.slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('admin.slider.delete');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('admin.setting');
        Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create');
        Route::post('/store', [SettingController::class, 'store'])->name('admin.setting.store');
        Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::post('/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::get('/delete/{id}', [SettingController::class, 'delete'])->name('admin.setting.delete');
    });
});
