<?php
 
class UsersController extends \BaseController {
	 
	 protected $layout = "layouts.main";

	 public function getRegister() {
		 
	     $this->layout->content = View::make('users.register');
	 }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$users = User::all();
		
		//$users = User::paginate(5);
		return View::make('users.index', compact('users'));
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
	public function show($id)
	{
		//
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	    $user = User::find($id);
	           if (is_null($user))
	           {
	               return Redirect::route('users.index');
	           }
	           return View::make('users.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	    $input = Input::all();
	           $validation = Validator::make($input, User::$rules);
	           if ($validation->passes())
	           {
	               $user = User::find($id);
	               $user->update($input);
	               return Redirect::route('users.show', $id);
	           }
	   return Redirect::route('users.edit', $id)
	               ->withInput()
	               ->withErrors($validation)
	               ->with('message', 'There were validation errors.');
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

	public function postCreate() {
			$validator = Validator::make(Input::all(), User::$rules);

			if ($validator->passes()) {
				$user = new User;
				$user->firstname = Input::get('firstname');
				$user->lastname = Input::get('lastname');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->save();

				return Redirect::to('users/login')->with('message', 'Thanks for registering!');
			} else {
				return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
			}
		}

		public function getLogin() {
			$this->layout->content = View::make('users.login');
		}

		public function postSignin() {
			if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
				return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
			} else {
				return Redirect::to('users/login')
					->with('message', 'Your username/password combination was incorrect')
					->withInput();
			}
		}

		public function getDashboard() {
			$this->layout->content = View::make('users.dashboard');
		}

		public function getLogout() {
			Auth::logout();
			return Redirect::to('users/login')->with('message', 'Your are now logged out!');
		}

}
