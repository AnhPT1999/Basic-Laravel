<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts',PostController::class)->middleware('auth:sanctum');

Route::apiResource('comment',CommentController::class);

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);

Route::get('get-post', [PostController::class,'getAllPost']);
Route::get('get-post-by-id/{id}',[PostController::class,'getPostById']);
Route::post('add-post', [PostController::class,'addPost']);
Route::put('update-post/{id}',[PostController::class,'updatePost']);
Route::delete('delete-post/{id}',[PostController::class,'deletePost']);

