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

Route::get('/todo','Todolistcontroller@index');
Route::post('/todo','Todolistcontroller@update');
Route::delete('/todo/{todo}','Todolistcontroller@delete');
Auth::routes();


Route::get('/messageboard','MessageBoardControll@index');
Route::post('/messageboard','MessageBoardControll@newPast');
Route::patch('/messageboard/{return_id}','MessageBoardControll@returnPast');


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/oath','OathControll@index');
Route::post('/oath','OathControll@test');
