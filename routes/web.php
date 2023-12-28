<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
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
//Route::get('product', function () {
//
//})->middleware('auth:api');

Route::get('/register',function(){
    echo 'register';
});

Route::post('/register', RegisterController::class);

//Route::get('/login',function(){
//    echo 'login';
//});

//Route::post('/login', LoginController::class)->name('login');
