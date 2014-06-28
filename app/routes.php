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
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
    return View::make('user', array('data'=>$data));
});
/* Rutas que requieren sesión iniciada */
Route::controller('user','usersController');
Route::get('user/logout', function() { Auth::logout(); return Redirect::to('/'); });
//Route::group(array('prefix'=>'user', 'before' => 'auth'), function(){});
Route::group(array('before'=>'auth'), function(){
	
	Route::get('user/dashboard','UsersController@showProfile');
});

/*
Route::get('register', array('uses' =>'RegisterController@index', 'as' =>'register.index'));
Route::post('register', array('uses' => 'RegisterController@store', 'as'=> 'register.store'));

/* Login nativo*/
/*Route::get('login', array('uses' => 'SessionController@create','as' => 'session.create'));
Route::post('login', array('uses' => 'SessionController@store', 'as' => 'session.store'));

/* Login de Facebook 
Route::get('user/facebok-auth', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array('redirect_uri' => url('user/facebok-auth/callback'),'scope' => 'email',);
    return Redirect::away($facebook->getLoginUrl($params));
});

/* Logout de sesión */
/*

Route::get('login', 'UsersController@login');

Route::get('user/register', 'UsersController@register');
Route::get('user/facebok-auth', 'UsersController@facebookAuth');
Route::get('user/facebook-auth/callback', 'UsersController@facebookAuthCallback');

Route::post('user/create','UsersController@create');
Route::post('user/signin','UsersController@signin');



/* Callback de Login de Facebook 
	
    
	Route::get('user/facebok-auth/callback', function() {
	   
	});
	*/
	