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
 Route::get('admin', 'LoginController@index');
 Route::post('admin/login-post', 'LoginController@create');
 Route::group(['prefix'=>'admin','middleware' => ['admin']],function() {
    
   
   // Route::post('/login', 'AdminController@login');
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/logout', 'AdminController@logout');
    Route::get('/profile', 'AdminController@profile');
    Route::post('/profile', 'AdminController@profile');
   
    Route::get('/users-list', 'UserController@index');
    Route::get('/user-add', 'UserController@useradd');
    Route::post('/user-add', 'UserController@useradd');
    
});
