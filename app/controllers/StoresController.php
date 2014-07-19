<?php
/*
 * @author Jose Calleja Esnal
 * 
 * 3 de julio de 2014
 */

class StoresController extends \BaseController {

	protected $layout = "layouts.main";
	public function __construct(){
		//
	}
	
	public function index(){
		//
	}

	public function getNewStore(){
		$this->layout->title = Lang::get('stores.store--new') ;
		$this->layout->content = View::make('stores.new');
	}

	public function postNewStore(){
		$user_id = Auth::user()->id;
		$validator = Validator::make(Input::all(),array('name' => 'required'));
		if($validator->passes()){
			$permalink = $this->generateStoreSlug(Input::get('name'));
			$store = new Store;
			$store->user_id = $user_id;
			$store->name = Input::get('name');
			$store->permalink = $permalink;
			$store->description = Input::get('description');
			$store->save();
			return Redirect::to('admin/stores')->withSuccess(Lang::get('stores.success--add'));
		}
		return Redirect::to('admin/stores')->withAlert(Lang::get('stores.error--add'));
	}
	

	public function listado(){
		$stores = Auth::user()->stores;
		$this->layout->content =  View::make('stores.index', compact('stores'));
	}

	public function generateStoreSlug($store_name) {
		$slug = Str::slug($store_name); //first make the name safe for a URL
		$slugCount = 0; //now count how many have the same slug structure
		$slugCount = count( Store::whereRaw("permalink REGEXP '^{$slug}(-[0-9]*)?$'")->get());
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug; //return original if its the only one
	}

	public function getStoreView($store_id = null){
		$store = Store::getStore($store_id);
		//let's check if the current users sessions has access to the store
		if($store == "false") //if(Store::userHasAccessToStore($store->id) == "false")
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		//if we made it through here, everythings fine, so let's display the store info.
		$this->layout->title = $store->name;
		$this->layout->content = View::make('stores.store')->withStore($store)->withProducts($this->getProducts($store_id));
		
	}

	
	/**
	 * Gets the Store products object provided the store_id or permalink
	 * @param $store_id
	 * @return Store [object]
	 */
	public function getProducts($store_id = null){
		if(is_null($store_id))
			return Redirect::to('products');
		$products = Store::getStore($store_id)->products();
		return $products;
	}

	public function getEdit($store_id = null){
		if(!$this->userHasAccessToStore($store_id))
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$store = Store::getStore($store_id);
		$this->layout->title = 'Edit Store';
		$this->layout->content = View::make('stores.edit')->withStore($store);
	}

	public function postEdit($id = null){
		$validator = Validator::make(Input::all(),array('name' => 'required'));
		if($validator->passes()) {
			$store = Store::getStore($id);		
			$store->name = Input::get('name');
			$store->description = Input::get('description');
			$store->save();
			return Redirect::to('admin/stores')->with('success', Lang::get('stores.success--edit'));
		}
		return Redirect::to('admin/stores')->withAlert(Lang::get('stores.error--edit'));
	}

	

}