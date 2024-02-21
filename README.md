<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Product Feedback


I have created APIs and Web Based Project 


- api.php
```php
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CommentApiController;
use App\Http\Controllers\Api\FeedbackApiController;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('feedback', FeedbackApiController::class)->only('index', 'store');
    Route::post('/feedback/{feedback}/comments', CommentApiController::class);
    Route::post('logout', [AuthApiController::class, 'logout']);
});
Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);
```


- web.php
```php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;

Route::middleware('auth')->group(function () {
    Route::resource('feedback', FeedbackController::class)->only('index', 'store', 'create');
    Route::get('/feedback/{feedback}/comments', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/feedback/{feedback}/comments', [CommentController::class, 'store'])->name('comment.store');
});
```
