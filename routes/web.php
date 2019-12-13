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

Route::get('logout', 'Auth\LoginController@logout')->middleware('auth');

//New
Route::get('/', 'NewController@index');
Route::post('/api/news/insert', 'NewController@store');
Route::get('/api/news/{type}', 'NewController@get_all_news');
Route::get('/api/news/detail/{id}', 'NewController@detail');
Route::post('/api/news/update/{id}', 'NewController@update');
Route::get('/api/news/delete/{id}', 'NewController@destroy');

// Emergency contact
Route::get('/admin/contact', 'EmergencyController@index');
Route::post('/api/insert_contact', 'EmergencyController@store');
Route::get('/api/get_all_contact', 'EmergencyController@get_all_contact');
Route::get('/api/edit_contact/{id}', 'EmergencyController@edit');
Route::post('/api/update_emer/{id}', 'EmergencyController@update');
Route::get('/api/delete_contact/{id}', 'EmergencyController@destroy');

// Education
Route::get('/admin/education', 'EducationController@index');
Route::post('/api/insert_education', 'EducationController@store');
Route::get('/api/get_all_education', 'EducationController@get_all_education');
Route::get('/api/edit_edu/{id}', 'EducationController@edit');
Route::post('/api/update_edu/{id}', 'EducationController@update');
Route::get('/api/delete_edu/{id}', 'EducationController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
