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

Route::get('/', 'PublicController@index')->name('homepage');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', 'AuthController@loginForm')->name('auth.login.form');
    Route::post('/login', 'AuthController@login')->name('auth.login');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::post('/add/story', 'AdminController@createStory')->name('admin.create.story');
});

Route::post('/logout', 'AuthController@logout')->middleware(['auth'])->name('auth.logout');
