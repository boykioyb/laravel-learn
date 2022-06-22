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

Route::get('/', function () {
    return view('home.dashboard');
});

// http://laravel-learn.test/posts
// http://laravel-learn.test/posts/create

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'read'])
        ->name('post.list');
    // http://laravel-learn.test/posts/create
    // GET, POST, PUT, DELETE, PATCH
    Route::get('/create', [\App\Http\Controllers\PostController::class, 'create'])
        ->name('post.create.ui');
    Route::post('/create', [\App\Http\Controllers\PostController::class, 'store'])
        ->name('post.create');

    //http://laravel-learn.test/posts/edit/1/2
    //http://laravel-learn.test/posts/a-b-d-s/
    Route::get('edit/{id}', [\App\Http\Controllers\PostController::class, 'edit'])
        ->where('id', '[0-9]+')
        ->name('post.edit');

    Route::post('update', [\App\Http\Controllers\PostController::class,'update'])
    ->name('post.update');

    Route::get('delete/{id}',[\App\Http\Controllers\PostController::class,'delete'])
    ->name('post.delete');
});
