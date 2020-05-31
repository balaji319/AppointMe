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

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
 

// Route::get('admin/senseis', function () {
//     return view('admin/senseis');
// });

Route::get('admin/sensei/details/{id}', function () {
    return view("admin/sensei/details");
});


Route::get('admin/senseis','Admin\\SenseiController@index');

Route::get('admin/list','Admin\\SenseiController@getListMentors');

Route::get('admin/billing', function () {
    return view('admin/billing');
});

Route::get('admin/settings', function () {
    return view('admin/setting');
});

Route::get('admin/users', function () {
    return view('admin/user');
});


Route::get('admin/roles', function () {
    return view('admin/role');
});
 
Route::get('admin/sync','Admin\\SenseiController@syncSenseisToDB');


Route::get("/google-calendar/connect", "GoogleCalendarController@connect");
Route::get("/google-calendar/connect1", "GoogleCalendarController@store");

Route::get("get-resource", "GoogleCalendarController@getResources");

Route::get("google-calendar", "GoogleCalendarController@googleCalendar");


// client id
//557573987275-3676imvuahjske1m062jfjdmuaqt3p9f.apps.googleusercontent.com

//client seceret
//oWKEpFaBOW_1HWGcE7zDeIU-