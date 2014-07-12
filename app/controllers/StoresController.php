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

	public function newStore(){
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
		return Redirect::to('stores')->with('success', Lang::get('stores.success--add'));
	}
	/**
	 * Current session user's stores.
	 */
	public function listado(){
		$user = Auth::user();
		$id = $user->id;
		$stores = Store::where('user_id','=',$id)->get();
		$this->layout->content =  View::make('stores.index', compact('stores'));
	}
	public function getSlug($title) {
		$slug = Str::slug($title);
		$slugCount = 0;
		/*falta implementar*/
		//$slugCount = count( Store::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}
	public function storeView($id = null){
		if(is_null($id))
			return Redirect::to('store');
		$store = $this->getStore($id);
		$this->layout->title = $store->name;
		$this->layout->content = View::make('stores.store')->withStore($store);
		//return $store->name;
	}

	public function products($id = null){
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

	

}