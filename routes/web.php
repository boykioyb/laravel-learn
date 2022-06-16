<?php

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

Route::get('/', function (){
    return view('home.dashboard');
});

// http://laravel-learn.test/posts
// http://laravel-learn.test/posts/create

Route::group(['prefix' => 'posts'],function (){
    Route::get('/',[\App\Http\Controllers\PostController::class,'list'])
        ->name('post.list');
    // http://laravel-learn.test/posts/create
    // GET, POST, PUT, DELETE, PATCH
    Route::get('/create',[\App\Http\Controllers\PostController::class,'create'])
        ->name('post.create.ui');
    Route::post('/create',[\App\Http\Controllers\PostController::class,'store'])
        ->name('post.create');
});
