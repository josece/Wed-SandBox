<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
| 
@tittle Wedding Invite RSVP System
@author Jose Antonio Calleja Esnal
@startdate 20 June 2014



*/

/**
 * Limite de acceso
 * niveles de acceso: 0 | 1 | 2 | 3
 */
Route::group(array('before' => 'auth|auth.admin'), function() {
	//Route::get('user/edit',array("before" => "roles:1-2-3,user/home", 'uses' => 'UsersController@getEdit'));		
	Route::get('user/edit',array('uses' => 'UsersController@getEdit'));		
});
/**
 * Aquí empieza todo
 */
Route::get('/', function() {
    return Redirect::to('user/home');
});

/**
 * Si intentan hacer login desde /login, los redirigimos a la página correcta
 */
Route::get('login', function() { return Redirect::to('user/login'); });

/**
 * Aquí se cargan los controladores RESTful
 */
Route::get('user', function() { return Redirect::to('user/home'); });
Route::controller('user','UsersController');
Route::controller('password','RemindersController');

/*
 * View Composer 
 * Crea un objeto $user que es usado siempre que se invoca la plantilla layout/main.blade.php
 */
View::composer(array('layout.main', 'users.home'), function($view) {
    $view->with('user',  Auth::user());
});

