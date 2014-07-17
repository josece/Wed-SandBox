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

	
}
