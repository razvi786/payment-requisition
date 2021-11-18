<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('action/trigger/{id}', 'ActionController@show')->name('action.trigger');

Route::get('/send-email/{requestId}', [MailController::class, 'sendEmail']);

Route::resource('user', UserController::class);
Route::resource('request', RequestController::class);
Route::resource('action', ActionController::class);
