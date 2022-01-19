<?php

use App\Http\Controllers\CateogryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false]);

Route::get('/', function () {
  return redirect('login');
});




Route::group(['middleware' => 'auth'], function () {

  Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

  Route::resource('users', UserController::class)->except('show');

  Route::resource('categories', CateogryController::class)->only('index');

  Route::resource('products', ProductController::class)->except('show');
});
