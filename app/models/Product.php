<?php
 
class Product extends Eloquent {
 
 	protected $table = 'products';

 	/**
	 * Retrieve the Category object where the current product is listed at
	 * @return category [object]
	 */
 	public function category() {
 		return $this->belongsTo('productCategory');
 	}

 	/**
	 * Retrieve the Store object where the current product is listed at
	 * @return store [object]
	 */
    public function store() {
        return $this->belongsTo('store');
    }

	
}
