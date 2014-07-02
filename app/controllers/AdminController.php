<?php
/*
 * @author Jose Calleja Esnal
 * 
 * sesiones de facebook basado en:
 * https://github.com/msurguy/laravel-facebook-login
 *
 */

class AdminController extends \BaseController {
	 

	protected $layout = "layouts.main";
	
	/**
	 * Builds object user
	 *
	 */

  	public function __construct(){
        //$this->beforeFilter('auth|auth.admin');
        $appname =  Lang::get('global.appname');
        view::share('appname', $appname);
    }
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdituser($id = null){
		if(empty($id)){
			$user = Auth::user();
		}else{
			$user = User::find($id);
		}
		$this->layout->title =  Lang::get('global.editinfo');
		$this->layout->scripts = array('assets/js/foundation/foundation.abide.js');
		$this->layout->content = View::make('admin.users.edit')->withUser($user);
	}

	
	/**
	 * Update the specified resource in storage.
	 * if the call comes with an ajax state a json object is retun, instead of a redirection.
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdituser($id = null) {
		$id = is_null($id) ? Auth::user()->id :$id;
		$input = Input::all();
		$validation = Validator::make($input,array(
			'email'=> 'required|unique:users,email,'.$id));
		//dd(Input::all());
		if ($validation->passes()) {
			$user = User::find($id);

			$user->role_id = Input::get('accesslevel');
			$user->email = Input::get('email');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			if(Input::get('password')!= '' )
				$user->password = Hash::make(Input::get('password'));
			$user->save();

			$response = array('success' => Lang::get('form.success--update'));
			if(Input::get('kind')!='ajax')
				return Redirect::to('admin/edituser/'.$id)->with('success', Lang::get('form.success--update'));
		}else{
			
			$response = array('alert' =>  $validation->messages());
		}
		
		if(Input::get('kind')!='ajax')
			return Redirect::to('admin/edituser/'.$id)->withInput()->withErrors($validation)->with('alert', Lang::get('form.error--validation'));
		return $response;
	}

}
