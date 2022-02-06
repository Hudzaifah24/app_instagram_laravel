<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExplodeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('comment', CommentController::class);

    Route::get('post/show/{id}', [PostController::class, 'show'])->name('post.show');

    Route::post('post/store', [PostController::class, 'store'])->name('post.store');

    Route::resource('explode', ExplodeController::class);

    Route::resource('profile', ProfileController::class);

    Route::put('photo/profile/{id}', [ProfileController::class, 'photo'])->name('profile.photo');

    Route::resource('passwordProfile', PasswordController::class);

});

Auth::routes();
