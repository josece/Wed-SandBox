<?php
/*
 * @author Jose Calleja Esnal
 * 
 * 3 de julio de 2014


 	getEditProduct(product_id)
	postEditProduct(product_id)
	getNewProduct(store_id)
	postNewProduct(store_id)
	generateProductSlug(product_name)
 */

class ProductsController extends \BaseController {

	protected $layout = "layouts.main";

	/**
	* get Add new product view
	* @param store_id
	*/
	public function getEditProduct($product_id = null){
		$product = Product::getProduct($product_id);
		if($product == "false") 
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$this->layout->title = Lang::get('stores.product--new');
		$this->layout->content = View::make('admin.products.edit')->withProduct($product);
	}

	/**
	* post Add new product view
	* @param store_id
	*/
	public function postEditProduct($product_id = null){
		$product = Product::getProduct($product_id);
		if($product == "false") //if(Store::userHasAccessToStore($store->id) == "false")
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		//$user_id = Auth::user()->id;

		$validator = Validator::make(Input::all(), array(
			'name' => 'required')
		);
			$product->name = Input::get('name');
			$product->description = Input::get('description');
			$product->price = Input::get('price');
			$product->save();
		return Redirect::to('admin/store/'. $product->store_id)->withSuccess(Lang::get('products.success--edit'));
	}
	/**
	* get Add new product view
	* @param store_id
	*/
	public function getNewProduct($store_id = null){
		$store = Store::getStore($store_id);
		if($store == "false") //if(Store::userHasAccessToStore($store->id) == "false")
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		$this->layout->title = Lang::get('stores.product--new');
		$this->layout->content = View::make('admin.products.new')->withStore($store);
	}
	/**
	* post Add new product view
	* @param store_id
	*/
	public function postNewProduct($store_id = null){
		$store = Store::getStore($store_id);
		if($store == "false") //if(Store::userHasAccessToStore($store->id) == "false")
			return Redirect::to('admin/stores')->withAlert(Lang::get('global.permissions--notenough'));
		//$user_id = Auth::user()->id;

		$validator = Validator::make(Input::all(), array(
			'name' => 'required')
		);
			$product = new Product;
			$product->name = Input::get('name');
			$product->description = Input::get('description');
			$product->price = Input::get('price');
			$product->permalink = $this->generateProductSlug($product->name);
			$product->store_id = $store_id;
			$product->save();
		return Redirect::to('admin/store/'. $store->permalink)->withSuccess(Lang::get('products.success--add'));
	}

	public function generateProductSlug($product_name) {
		$slug = Str::slug($product_name); //first make the name safe for a URL
		$slugCount = 0; //now count how many have the same slug structure
		$slugCount = count( Product::whereRaw("permalink REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug; //return original if its the only one
	}
}