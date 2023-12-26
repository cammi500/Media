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
    //tr post
    Route::get('trend_post',[TrendPostController::class, 'index'])->name('admin#trendPost');
    //category
    Route::get('category',[CategoryController::class, 'index'])->name('admin#category');
});
