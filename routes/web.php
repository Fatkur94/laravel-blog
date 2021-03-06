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

Route::get('/index', 'PagesController@index');
Route::get('/services', 'PagesController@services');
Route::get('/about', 'PagesController@about');
Route::get('/menu', 'PagesController@menu');

Route::resource('posts', 'PostsController');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return '<h1>Hello World</h1>';
});



//Route::get('/about', function () {
//    return view('pages.about');
//});

//Route::get('/users/{id}/{name}', function ($id, $name){
//    return 'This is users '. $id . ' with a name ' . $name;
//});
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
