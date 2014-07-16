<?php
 
class Product extends Eloquent {
 
 	protected $table = 'products';

 	/*
	* Definicion de relaciones
	*/
 	public function category() {
 		return $this->belongsTo('productCategory');
 	}
    public function store() {
        return $this->belongsTo('store');
    }

	
}
