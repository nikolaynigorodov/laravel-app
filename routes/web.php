<?php

use App\Http\Controllers\HomeController as HomeControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;

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


Route::group(['namespace' => 'App\Http\Controllers'], function(){

    Route::get('/', 'StartController@index');
    Route::get('books', 'StartController@books');
    Route::get('categories', 'StartController@categories');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['admin.middleware:admin,/home', 'role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');
    Route::resource('/users', \App\Http\Controllers\Admin\UsersController::class);
});

/*Route::group(['middleware' => 'admin.middleware:admin,/home', 'role:admin', 'prefix' => 'admin_panel', 'namespace' => 'App\Http\Controllers\Admin'], function (){
    Route::get('/', 'HomeController@index')->name('homeAdmin');
    Route::get('/users', 'UsersController@index')->name('usersAdmin');
});*/

