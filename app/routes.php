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
 * Limite de acceso en Filtros
 * niveles de acceso:
 * auth.admin - 3
 * auth.medium - 2
 * auth.basic -1
 * guest() - 0
 */
//Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
Route::group(array('prefix' => 'admin','before' => 'auth|auth.admin'), function() {
	Route::controller('admin','AdminController');
	/* List User */
	Route::get('users','AdminController@getUsers');
	/* Edit User */
	Route::get('user/{id}/edit',array('uses' => 'AdminController@getUsersedit'));
	Route::post('user/{id}/edit',array('uses' => 'AdminController@postUsersedit'));
});

Route::group(array('prefix' => 'admin','before' => 'auth'), function() {
	/* List Stores*/
	Route::get('stores/', array('uses' => 'StoresController@listado'));
	/* New Store */
	Route::get('store/new', array('uses' => 'StoresController@getNewStore'));
	Route::post('store/new', array('uses' => 'StoresController@postNewStore'));
	/* Edit Store */
	Route::get('store/{id}/edit', array('uses' => 'StoresController@getEdit'));
	Route::post('store/{id}/edit', array('uses' => 'StoresController@postEdit'));
	/* List Products */
	Route::get('store/{id}', array('uses' => 'StoresController@getStoreView'));
	Route::get('store/{id}/products', array('uses' => 'StoresController@getStoreView'));
	/* New Product */
	Route::get('store/{id}/product/new', array('uses' => 'ProductsController@getNewProduct'));	
	Route::post('store/{id}/product/new', array('uses' => 'ProductsController@postNewProduct'));
	/* Edit Product */
	Route::get('product/{id}/edit', array('uses' => 'ProductsController@getEditProduct'));	
	Route::post('product/{id}/edit', array('uses' => 'ProductsController@postEditProduct'));
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
Route::get('products/', array('uses' => 'ProductsController@index'));

Route::get('store/{id}', array('uses' => 'StoresController@getStore'));
Route::get('product/{id}', array('uses' => 'ProductsController@getProduct'));
/**
 * Aquí se cargan los controladores RESTful
 */
Route::controller('user','UsersController');
Route::controller('password','RemindersController');
/*
 * View Composer 
 * Crea un objeto $user que es usado siempre que se invoca la plantilla layout/main.blade.php
 */
View::composer(array('layout.main', 'users.home'), function($view) {
    $view->with('user',  Auth::user());
});

