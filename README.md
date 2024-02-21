<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



```bash
PHP Version ............. 8.1.10  
Laravel Version ......... 10.44.0  
Composer Version .......... 2.4.2  
```

### Setup Instructions
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
  (windows wont let you do it, so you have to open your console cd your project root directory and run `mv .env.example .env` )
- Open the console and cd your project root directory
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan serve`


### Login Credentials
| Username/Email   | Password    | 
|------------------|-------------|
| ahmad@ikonic.com | password    |
| ali@ikonic.com   | password    |



## Product Feedback

### `Note:` 
<p>
As it is mentioned in the email that  You have the flexibility to select your preferred frontend technology from the options I have Done this with Blade and Laravel also I have Created APIs of it and I have know basic knowledge of VUE js but it will choose blade you can review my code base
</p>


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
    // other routes
    Route::resource('feedback', FeedbackController::class)->only('index', 'store', 'create');
    Route::get('/feedback/{feedback}/comments', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/feedback/{feedback}/comments', [CommentController::class, 'store'])->name('comment.store');
});
```

### Click here to watch 👇🏻 

Demo Video : https://www.loom.com/share/d711d3fb43cf4945b7e0be89de7f415f?sid=6dee8be4-686d-4886-9c31-b4270e2b78c6




