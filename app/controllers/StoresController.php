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
		$permalink = $this->getSlug(Input::get('name'));
		$store = new Store;
		$store->user_id = $user_id;
		$store->name = Input::get('name');
		$store->permalink = $permalink;
		$store->description = Input::get('description');
		$store->save();
		return Redirect::to('admin/stores')->with('success', Lang::get('stores.success--add'));
	}
	/**
	 * get user's stores.
	 * @param user_id
	 * @return stores [object]
	 */
	public function getStores($user_id = null){
		if(is_null($user_id)){
			$user = Auth::user();
			$user_id = $user->id;
		}
		$stores = Store::where('user_id','=',$user_id)->get();
		return $stores;
	}

	public function listado(){
		$stores = $this->getStores();
		$this->layout->content =  View::make('stores.index', compact('stores'));
	}

	public function getSlug($title) {
		$slug = Str::slug($title);
		$slugCount = 0;
		/*falta implementar*/
		//$slugCount = count( Store::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}

	/**
	* Get Store Owner
	* @param store_id
	* @return user_id
	*/
	public function getStoreOwner($store_id = null){
		if(is_null($store_id))
			return false;
		 $stores = $this->getStore($store_id);
		return  $stores->user_id;
	}

	public function storeView($store_id = null){
		if(is_null($store_id))
			return Redirect::to('admin/stores');
		//if not admin, if store doesn't belong to current session, error.
		$user = Auth::user();
		//if the store ownser is the same as the sessions
		if($this->getStoreOwner($store_id) != $user->id 
			&& !$user->hasRole('admin'))
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$store = $this->getStore($store_id);
		$this->layout->title = $store->name;
		$this->layout->content = View::make('stores.store')->withStore($store);
	}
	/**
	 * Gets the Store products object provided the store_id or permalink
	 * @param $store_id
	 * @return Store [object]
	 */
	public function getProducts($id = null){
		if(is_null($id))
			return Redirect::to('products');

		$store_id = $this->getStore($id)->id;
		$products = Product::where('store_id','=', $store_id)->get();
		return $products;

	}
	/**
	 * Gets the Store object provided the id or permalink
	 * @param $id
	 * @return Store [object]
	 */
	private function getStore($id){
		if (is_numeric($id)) {
			$store = Store::find($id);
		} else {
       		$store = Store::where('permalink', '=', $id)->first();
   		}
   		return $store;
	}

	public function getEdit($id = null){
		$store = $this->getStore($id);
		$this->layout->title = 'Edit Store';
		$this->layout->content = View::make('stores.edit')->withStore($store);
	}
	public function postEdit($id = null){
		$validator = Validator::make(Input::all(),array('name' => 'required'));
		$store = $this->getStore($id);
		$store->name = Input::get('name');
		$store->description = Input::get('description');
		$store->save();
		return Redirect::to('admin/stores')->with('success', Lang::get('stores.success--edit'));
	}

	

}