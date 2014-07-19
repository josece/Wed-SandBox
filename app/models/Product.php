<?php
 
class Product extends Eloquent {
 
 	protected $table = 'products';

 	public function taxonomies() {
		return $this->belongsToMany('Product');
	}

 	/**
	 * Retrieve the Store object where the current product is listed at
	 * @return store [object]
	 */
    public function store() {
        return $this->belongsTo('store');
    }

	/**
	 * Retrieve a store object from its ID or permalink slug
	 * @param store_id | store_slug
	 * @return Store [object]
	 */
	public function scopeGetProduct($query, $product_id = null){
		if(is_null($product_id)){
			return "false";
		}
		if (is_numeric($product_id)) {
			$product = $query->findOrFail($product_id);
		} else {
       		$product = $query->where('permalink', '=', $product_id)->firstOrFail();
   		}
   			//let's check the access 
   			$user = Auth::user();
   			if( $product->store() != $user->id && !$user->hasRole('admin'))
   				return "false";
   		return $product;
	}
	
}
