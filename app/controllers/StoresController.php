<?php
/*
 * @author Jose Calleja Esnal
 * 
 * 3 de julio de 2014
 */

class StoresController extends \BaseController {

	public function __construct(){
		//
	}
	
	public function index(){
		//
	}

	public function store($id = null){
		if(is_null($id))
			return Redirect::to('store');
		$store = $this->getStore($id);
		return $store->name;
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