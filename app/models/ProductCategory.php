<?php
 
class ProductCategory extends Eloquent {
 	
 	protected $table = 'product_categories	';

	public function products() {
		return $this->hasMany('Product');
	}

	public function children() {
		return $this->hasMany('ProductCategory','parent_id')
	} 
}