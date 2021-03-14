<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostUnlikeController;
use App\Http\Controllers\UserPostController;

//auth
//register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

/*USERS*/
Route::get('/users/{user}/posts', [UserPostController::class, 'index'])->name('users.posts');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
/*POSTS*/
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

/*LIKE | UNLIKE*/
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::post('/posts/{post}/unlikes', [PostUnlikeController::class, 'store'])->name('posts.unlikes');

Route::get('/', function () {
    return view('home');
})->name('home');
