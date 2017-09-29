<?php

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

Route::post('/login' , 'Auth\LoginController@login');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/v1', 'HomeController@v1')->name('v1');
