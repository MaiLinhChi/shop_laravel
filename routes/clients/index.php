<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::prefix('client')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('client.home');
});
