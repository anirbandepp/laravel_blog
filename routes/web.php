<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [FrontEndController::class, 'home'])->name('home_page');
Route::get('/about', [FrontEndController::class, 'about'])->name('about');

Route::get('/category/{slug}', [FrontEndController::class, 'category'])->name('category');

Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');
Route::get('/post/{slug}', [FrontEndController::class, 'post'])->name('post');


// Admin Panel Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Category
    Route::get('/category_index', [CategoryController::class, 'index'])->name('category_index');
    Route::get('/category_create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('/category_store', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/category_edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::post('/category_update/{id}', [CategoryController::class, 'update'])->name('category_update');
    Route::post('/category_destroy/{id}', [CategoryController::class, 'destroy'])->name('category_destroy');

    // Tag
    Route::get('/tag_index', [TagController::class, 'index'])->name('tag_index');
    Route::get('/tag_create', [TagController::class, 'create'])->name('tag_create');
    Route::post('/tag_store', [TagController::class, 'store'])->name('tag_store');
    Route::get('/tag_edit/{id}', [TagController::class, 'edit'])->name('tag_edit');
    Route::post('/tag_update/{id}', [TagController::class, 'update'])->name('tag_update');
    Route::post('/tag_destroy/{id}', [TagController::class, 'destroy'])->name('tag_destroy');

    // Post
    Route::get('/post_index', [PostController::class, 'index'])->name('post_index');
    Route::get('/post_create', [PostController::class, 'create'])->name('post_create');
    Route::post('/post_store', [PostController::class, 'store'])->name('post_store');
    Route::get('/post_edit/{id}', [PostController::class, 'edit'])->name('post_edit');
    Route::post('/post_update/{id}', [PostController::class, 'update'])->name('post_update');
    Route::post('/post_delete/{id}', [PostController::class, 'destroy'])->name('post_delete');
    Route::get('/post_show/{id}', [PostController::class, 'show'])->name('post_show');

    // User Info
    Route::get('/user_index', [UserController::class, 'index'])->name('user_index');
    Route::get('/user_create', [UserController::class, 'create'])->name('user_create');
    Route::post('/user_store', [UserController::class, 'store'])->name('user_store');
    Route::get('/user_edit/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::post('/user_update/{id}', [UserController::class, 'update'])->name('user_update');
    Route::post('/user_destory/{id}', [UserController::class, 'destory'])->name('user_destory');
    Route::get('/user_show', [UserController::class, 'show'])->name('user_show');
    Route::post('/profile_update', [UserController::class, 'profile_update'])->name('profile_update');
});
