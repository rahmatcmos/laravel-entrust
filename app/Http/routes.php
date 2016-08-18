<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['prefix' => 'users'], function () {
        Route::get('/create', ['as' => 'user_create', 'uses' => 'UsersController@create']);
        Route::post('/store', ['as' => 'user_store', 'uses' => 'UsersController@store']);
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', ['as' => 'role_index', 'uses' => 'RolesController@index']);
        Route::get('/create', ['as' => 'role_create', 'uses' => 'RolesController@create']);
        Route::post('/store', ['as' => 'role_store', 'uses' => 'RolesController@store']);
    });

    Route::group(['prefix' => 'perms'], function (){
        Route::get('/assigned', 'PermissionsController@permsAssigned');
        Route::post('/assign', 'PermissionsController@assign');
        Route::delete('/remove', 'PermissionsController@remove');
    });

});

Route::auth();

Route::get('/home', 'HomeController@index');
