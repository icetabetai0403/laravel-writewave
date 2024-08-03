<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [WebController::class, 'index'])->name('top');

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(commentController::class)->group(function () {
        Route::post('comments', 'store')->name('comments.store');
        Route::get('comments', 'index')->name('comments.index');
        Route::get('comments/{comment}/edit', 'edit')->name('comments.edit');
        Route::put('comments/{comment}', 'update')->name('comments.update');
        Route::delete('comments/{comment}', 'destroy')->name('comments.destroy');
    });
}); 