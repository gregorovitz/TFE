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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/roles','RoleController');
Route::resource('/permissions','PermissionController');
Route::resource('/user','UserController');
route::get('/location/{id}','CalendrierVisitorController@show')->name('location.show');
Route::post('/event','EventController@store')->name('event.add');
Route::resource('/event','EventController');
Route::resource('/print','ContractPrintLocation');