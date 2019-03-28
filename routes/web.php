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
use App\DataTables\EventInternDataTable;
Route::get('/', function () {
    return view('index');
});

Auth::routes();


Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('{lang}/roles','RoleController');
Route::resource('/permissions','PermissionController');
Route::resource('/user','UserController');
Route::resource('/event','EventController')->except('create');
Route::resource('/eventInterne','EventInterneController')->except(['create','view']);//except view
Route::resource('/print','ContractPrintLocation');

Route::post('/event','EventController@store')->name('event.add');

route::get('/location/{id}','CalendrierVisitorController@show')->name('location.show');

Route::get('/event/{date}/{hour}/{room}/location','EventController@create');
Route::get('/eventInterne/{date}/{hour}/{room}/activite','EventInterneController@create');


route::get('/anyData','EventController@anyData')->name('event.data');
Route::get('/column-search-data','EventInterneController@anyColumnSearchData')->name('eventInterne.data');
Route::get('/users','PermissionController@getPermission')->name('get.Permission');

Route::get('/eventInterne',function (EventInternDataTable $dataTable){
    return $dataTable->render('eventInterne.view');
});