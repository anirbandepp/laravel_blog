<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
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

Route::get('/', function () {
    return view('website.home');
})->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin Panel Routes
Route::group(['prefix' => 'admin'], function () {
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
});
