<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CommentApiController;
use App\Http\Controllers\Api\FeedbackApiController;
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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('feedback', FeedbackApiController::class)->only('index', 'store');
    Route::post('/feedback/{feedback}/comments', CommentApiController::class);
    Route::post('logout', [AuthApiController::class, 'logout']);
});

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
