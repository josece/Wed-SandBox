<?php
/*
 * @author Jose Calleja Esnal
 * 
 * sesiones de facebook basado en:
 * https://github.com/msurguy/laravel-facebook-login
 *
 */

class StoresController extends \BaseController {

	public function store($id){
		$store = Store::find($id);
		return $store->name;
	}

}