<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.profile.index');
    // })->name('dashboard');
    
    //admin
    Route::get('dashboard',[ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class, 'updateAdmin'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class, 'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/changePassword',[ProfileController::class, 'changePassword'])->name('admin#changePassword');
    //admin list
    Route::get('admin/list',[ListController::class, 'index'])->name('admin#list');
    Route::get('admin/list/{id}',[ListController::class, 'accountDelete'])->name('admin#listDelete');
    Route::post('admin/list',[ListController::class, 'adminListSearch'])->name('admin#listSearch');

    //post
    Route::get('post',[PostController::class, 'index'])->name('admin#post');
    Route::post('post',[PostController::class, 'postCreate'])->name('post#Create');
    Route::get('post/postDelete/{id}',[PostController::class, 'deletePost'])->name('post#Delete');
    Route::post('post/search',[PostController::class, 'searchPost'])->name('post#Search');
    Route::get('post/edit/{id}',[PostController::class,'editPost'])->name('post#Edit');
    Route::post('post/update/{id}',[PostController::class,'updatePost'])->name('post#Update');

    //tr post
    Route::get('trend_post',[TrendPostController::class, 'index'])->name('admin#trendPost');

    //category
    Route::get('category',[CategoryController::class, 'index'])->name('admin#category');
    Route::post('category',[CategoryController::class, 'createCategory'])->name('admin#categoryCreate');
    Route::get('category/{id}',[CategoryController::class, 'deleteCategory'])->name('category#delete');
    Route::post('category/search',[CategoryController::class,'searchCategory'])->name('category#search');
    Route::get('category/edit/{id}',[CategoryController::class, 'editCategory'])->name('category#edit');
    Route::post('category/update/{id}',[CategoryController::class, 'updateCategory'])->name('category#update');
});
