<?php
/*
 * @author Jose Calleja Esnal
 * 
 * 3 de julio de 2014
 */

class ProductsController extends \BaseController {

	protected $layout = "layouts.main";
	
	/**
	* get Add new product view
	* @param store_id
	*/
	public function getNewProduct($store_id = null){
		if(!App::make('StoresController')->userHasAccessToStore($store_id))
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$store = $this->getStore($store_id);
		$this->layout->title = Lang::get('stores.product--new');
		$this->layout->content = View::make('products.new')->withStore($store);
	}
	/**
	* post Add new product view
	* @param store_id
	*/
	public function postNewProduct($store_id = null){
		if(!App::make('StoresController')->userHasAccessToStore($store_id))
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$store = $this->getStore($store_id);
		$user_id = Auth::user()->id;
			$product = new Product;
			$product->name = Input::get('name');
			$product->description = Input::get('description');
			$product->price = Input::get('price');
			$product->store_id = $store_id;
			$product->save();
		$this->layout->title = Lang::get('stores.product--new');
		$this->layout->content = View::make('products.new')->withStore($store);
	}

	public function generateProductSlug($product_name) {
		$slug = Str::slug($product_name); //first make the name safe for a URL
		$slugCount = 0; //now count how many have the same slug structure
		$slugCount = count( Product::whereRaw("permalink REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug; //return original if its the only one
	}
}