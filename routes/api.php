<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);

Route::post('user/register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

//post api routes
Route::get('getAllList',[PostController::class,'allPostList']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/details',[PostController::class,'postDetails']);

//category routes api
Route::get('getAllCategory',[CategoryController::class,'allCategoryList']);
Route::post('category/search',[CategoryController::class,'categorySearch']);
