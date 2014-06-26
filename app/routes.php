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


sesiones de facebook basado en:
https://github.com/msurguy/laravel-facebook-login
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

/*
Route::get('register', array('uses' =>'RegisterController@index', 'as' =>'register.index'));
Route::post('register', array('uses' => 'RegisterController@store', 'as'=> 'register.store'));

/* Login nativo*/
/*Route::get('login', array('uses' => 'SessionController@create','as' => 'session.create'));
Route::post('login', array('uses' => 'SessionController@store', 'as' => 'session.store'));

/* Login de Facebook */
Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array('redirect_uri' => url('/login/fb/callback'),'scope' => 'email',);
    return Redirect::away($facebook->getLoginUrl($params));
});

/* Logout de sesión */
Route::get('logout', function() { Auth::logout(); return Redirect::to('/'); });
//Route::get('users', array('uses' => 'UsersController@index', 'as' => 'users.index'));
Route::controller('users', 'UsersController');




/* Callback de Login de Facebook */
	
    
	Route::get('login/fb/callback', function() {
	    $code = Input::get('code');
	    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
 
	    $facebook = new Facebook(Config::get('facebook'));
	    $uid = $facebook->getUser();
 
	    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
 
	    $me = $facebook->api('/me');
		/*
		Los valores que recibimos de Facebook son un arreglo $me: 
		array(11) { ["id"],
			 		["email"]
					["first_name"]
					["gender"]
					["last_name"]
					["link"]
					["locale"] "en_US" 
					["name"]
			 		["timezone"]=> int(-5) 
					["updated_time"] 
					["verified"]=> bool(true) 
		}
	 */
		//dd($me); //equivalente a un var_dump
	    $profile = Profile::whereUid($uid)->first();
	    if (empty($profile)) {
 
	        $user = new User;
	        $user->name = $me['first_name'].' '.$me['last_name'];
	        $user->email = $me['email'];
	        $user->photo = 'https://graph.facebook.com/'.$uid.'/picture?type=large';
 
	        $user->save();
 
	        $profile = new Profile();
	        $profile->uid = $uid;
	        $profile->username = $uid;
	        $profile = $user->profiles()->save($profile);
	    }
 
	    $profile->access_token = $facebook->getAccessToken();
	    $profile->save();
 
	    $user = $profile->user;
 
	    Auth::login($user);
 
	    return Redirect::to('/')->with('message', 'Logged in with Facebook');
	});
	
	