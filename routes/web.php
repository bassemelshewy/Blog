<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [PostsController::class, 'index'])->name('posts.index');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/create', [PostsController::class, 'create'])->name('posts.create');
        Route::post('/', [PostsController::class, 'store'])->name('posts.store');
        Route::get('/{id}/show', [PostsController::class, 'show'])->name('posts.show');
        Route::get('/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}/update', [PostsController::class, 'update'])->name('posts.update');
        Route::delete('/{id}/delete', [PostsController::class, 'delete'])->name('posts.destroy');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/{postId}', [CommentsController::class, 'store'])->name('comments.store');
        Route::get('/{postId}/show', [CommentsController::class, 'fetchComments'])->name('comments.fetch');
        Route::delete('/{id}/delete', [CommentsController::class, 'delete'])->name('comments.destroy');
    });
});

require __DIR__.'/auth.php';
