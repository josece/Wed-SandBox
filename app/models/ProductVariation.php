<?php
 
class ProductVariation extends Eloquent {
 
 	protected $table = 'products_variations';

	public function product() {
        return $this->belongsTo('Product');
    }

 }
