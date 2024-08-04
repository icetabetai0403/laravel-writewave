<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',  [WebController::class, 'index'])->name('top');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', PostController::class);

    Route::controller(commentController::class)->group(function () {
        Route::post('comments', 'store')->name('comments.store');
        Route::get('comments', 'index')->name('comments.index');
        Route::get('comments/{comment}/edit', 'edit')->name('comments.edit');
        Route::put('comments/{comment}', 'update')->name('comments.update');
        Route::delete('comments/{comment}', 'destroy')->name('comments.destroy');
    });

    Route::post('favorites/{post_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{post_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
    });
}); 