<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [WebController::class, 'index'])->name('top');

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class)->middleware(['auth', 'verified']);