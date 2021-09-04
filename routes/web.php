<?php

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

use App\Http\Controllers\pages;
use App\Http\Controllers\users;
use App\Http\Controllers\admin;

// Route::get('/', function () {
//     return view('index');
// });


//pages
Route::get('/', [pages::class, 'index']);
Route::get('/about', [pages::class, 'about']);

// Route::get('/product-info/{id}', function ($id) {
//     return "This is post ".$id;
// });

Route::get('/product-info/{id}', [pages::class, 'productinfo']);





//user login-signup
Route::get('/login', [users::class, 'login']);
Route::get('/signup', [users::class, 'signup']);

Route::post('/signup', [users::class, 'signupPost']);
Route::post('/login', [users::class, 'loginPost']);

//loggedin user
Route::get('/user', [users::class, 'user']);
Route::post('/user', [users::class, 'userEdit']);

Route::get('/logout', [users::class, 'logout']);

//admin
Route::get('/dash', [admin::class, 'index']);
Route::post('/dash-product', [admin::class, 'product']);
Route::post('/dash-category', [admin::class, 'category']);



