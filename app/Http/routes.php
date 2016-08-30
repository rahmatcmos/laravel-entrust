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

    Route::group(['prefix' => 'users', 'middleware' => ['role:admin']], function () {
        Route::get('/', ['as' => 'user_index', 'uses' => 'UsersController@index']);
        Route::get('/create', ['as' => 'user_create', 'uses' => 'UsersController@create']);
        Route::post('/store', ['as' => 'user_store', 'uses' => 'UsersController@store']);
        Route::get('/edit/{user}', ['as' => 'user_edit', 'uses' => 'UsersController@edit']);
        Route::patch('/update/{user}', ['as' => 'user_update', 'uses' => 'UsersController@update']);
        Route::delete('/{user}', ['as' => 'user_delete', 'uses' => 'UsersController@destroy']);
    });

    Route::group(['prefix' => 'roles', 'middleware' => ['role:admin|owner']], function () {
        Route::get('/', ['as' => 'role_index', 'uses' => 'RolesController@index']);
        Route::get('/create', ['as' => 'role_create', 'uses' => 'RolesController@create']);
        Route::post('/store', ['as' => 'role_store', 'uses' => 'RolesController@store']);
        Route::get('/edit/{role}', ['as' => 'role_edit', 'uses' => 'RolesController@edit']);
        Route::patch('/update/{role}', ['as' => 'role_update', 'uses' => 'RolesController@update']);
        Route::delete('/{role}', ['as' => 'role_delete', 'uses' => 'RolesController@destroy']);
    });

    Route::group(['prefix' => 'perms', 'middleware' => ['role:admin']], function () {
        Route::get('/assigned', 'PermissionsController@permsAssigned');
        Route::post('/assign', 'PermissionsController@assign');
        Route::delete('/remove', 'PermissionsController@remove');
    });

});

Route::auth();

Route::get('/home', 'HomeController@index');
