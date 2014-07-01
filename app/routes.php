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

/* Inicio de todo */
Route::get('/', function()
{
    /*$data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }*/
    return Redirect::to('user/home');
});

Route::get('login', function() { return Redirect::to('user/login'); });
/* Rutas que requieren sesión iniciada */

Route::controller('user','usersController');

/*
 * View Composer 
 * Crea un objeto $user que es usado siempre que se invoca la plantilla layout/main.blade.php
 */
View::composer(array('layout.main', 'users.home'), function($view) {
    $view->with('user',  Auth::user());
});

	