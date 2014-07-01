<?php
/*
 * @author Jose Calleja Esnal
 * 
 * sesiones de facebook basado en:
 * https://github.com/msurguy/laravel-facebook-login
 *
 */

class UsersController extends \BaseController {
	 

	protected $layout = "layouts.main";
	
	/**
	 * Builds object user
	 *
	 */

  	public function __construct(){
        $this->beforeFilter('auth', 
        	array('except' =>  
        		array('getLogin' ,
        			'getRegister',
        			'postSignin',
        			'postCreate',
					'getFacebookauth',
					'getFacebookcallback'
					
        		)
        	)
        );
        $appname = "App Name";
        view::share('appname', $appname);
    }
	
	 public function getRegister() {
	 	//si tienen ya una sesion iniciada, no se puede ver el formulario de login
	 	 if (Auth::check()) {
	 	 	return Redirect::to('user/home');
	 	 }
	 	 $this->layout->title = "Sign up";
	 	 $this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		 $this->layout->content = View::make('users.register');
	 }
	 
	
	
	
	/**
	 * Gets Facebook object
	 *
	 * @param  
	 * @return redirect
	 */
	public function getFacebookauth()
	{
		
	    $facebook = new Facebook(Config::get('facebook'));
	    $params = array('redirect_uri' => url('/user/facebookcallback'),'scope' => 'email',);
	    return Redirect::away($facebook->getLoginUrl($params));
	}
	


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = null)
	{
		$this->layout->title = "Edit Info";
	  
		if(empty($id)){
			$user = Auth::user();
			$id = $user->id;
		}
		$user = User::find($id);
		   /* if (is_null($user)) {
		    	return Redirect::to('/user/dashboard');
		    }*/
		$this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		$this->layout->content = View::make('users.edit')->withUser($user);
	    
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id) {
		$input = Input::all();
		$validation = Validator::make($input,array(
			'email'=> 'required|unique:users,email,'.$id));

		if ($validation->passes()) {
			$user = User::find($id);
			$user->email = Input::get('email');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			if(Input::get('password')!= '' )
				$user->password = Hash::make(Input::get('password'));
			$user->save();
           //$user->update($input);
			return Redirect::to('user/edit/'. $id)->with('success', 'Info updated');
		}
		return Redirect::to('user/edit/'.$id)
		->withInput()
		->withErrors($validation)
		->with('alert', 'There were validation errors.');
	}

	/**
	 * Gets the data from the Create User Form, creates user and stores to database 
	 * @return redirect
	 */
	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('user/login')->with('success', 'Thanks for registering! You can now log in.');
		} else {
			return Redirect::to('user/register')->with('alert', 'Something went wrong')->withErrors($validator)->withInput();
		}
	}
	
	/**
	 * Sets the layout content with the login view. 
	 */
	public function getLogin() {
		//si tienen ya una sesion iniciada, no se puede ver el formulario de login
		if (Auth::check()) {
			return Redirect::to('user/home');
		}
		$this->layout->title = "Login";
		$this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		$this->layout->content = View::make('users.login');
	}

	/**
	 * Gets the sign in data and attempts to login. 
	 * @return Redirect
	 */
	public function postSignin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('user/home');//->with('message', 'You are now logged in!');
		} else {
			return Redirect::to('user/login')
				->with('alert', 'Your username/password combination was incorrect')
				->withInput();
		}
	}
	/**
	 * Sets the layout content with the login view. 
	 */
	public function getHome() {
		$this->layout->content = View::make('users.home');
	}
	/**
	 * Logouts user
	 */
	public function getLogout() {
		Auth::logout();
		return Redirect::to('user/login');//->with('message', 'Your are now logged out!');
	}
		

	/*
	 * Facebook Auth Callback
	 */
	public function getFacebookcallback() {
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
				$user->firstname = $me['first_name'];
				$user->lastname = $me['last_name'];
		        //$user->name = $me['first_name'].' '.$me['last_name'];
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
			return Redirect::to('user/home');
		    //return Redirect::to('/')->with('message', 'Logged in with Facebook');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			//
			 return View::make('users.create');
		}


		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store()
		{
			//
		    $input = Input::all();
		           $validation = Validator::make($input, User::$rules);

		           if ($validation->passes())
		           {
		               User::create($input);

		               return Redirect::route('users.index');
		           }

		           return Redirect::route('users.create')
		               ->withInput()
		               ->withErrors($validation)
		               ->with('message', 'There were validation errors.');
		}


		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function getShow($id)
		{
			//
		
		
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function destroy($id)
		{
			//
		    User::find($id)->delete();
		           return Redirect::route('users.index');
		}
}
