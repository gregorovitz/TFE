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
use App\DataTables\EventDataTable;
Route::get('/', function () {
    return view('index');
});

Auth::routes();


Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/room','Roomcontroller')->except('swow');
Route::resource('/typeEvent','TypeEventcontroller')->except('swow');
Route::resource('/roles','RoleController');
Route::resource('/organisation','OrganisationController')->except('show');
Route::resource('/permissions','PermissionController');
Route::resource('/user','UserController');
Route::resource('/event','EventController')->except('create');
//Route::resource('/eventInterne','EventInterneController')->except(['create','view']);//except view
Route::resource('/print','ContractPrintLocation');


Route::post('/event','EventController@store')->name('event.add');
Route::get('/payement/{id}','EventController@payementvalidateEvent')->name('event.payement');
route::get('/validate/{id}','EventController@validateEvent')->name('event.validate');
route::get('/location/{id}','CalendrierVisitorController@show')->name('location.show');

Route::get('/event/{date}/{hour}/{room}/location','EventController@create');
//Route::get('/eventInterne/{date}/{hour}/{room}/activite','EventInterneController@create');

Route::get('/user/role/{id}','UserController@editRole')->name('user_role.edit');
Route::post('/user/role/{id}','UserController@updateRole')->name('user_role.update');
/*route::get('/anyData','EventController@anyData')->name('event.data');*/
//Route::get('/column-search-data','EventInterneController@anyColumnSearchData')->name('eventInterne_supprimer.data');
Route::get('/users','PermissionController@getPermission')->name('get.Permission');

/*Route::get('/eventInterne',function (EventInternDataTable $dataTable){
    return $dataTable->render('eventInterne_supprimer.view');
});*/
Route::get('/markAsRead/{id}/{event}',function($id,$event){
    auth()->user()->unReadNotifications->where('id',$id)->markAsRead();
    return redirect('/event/'.$event);
});
//Route::get('/event',function (EventDataTable $dataTable){
//    return $dataTable->render('events.view');
//});