<?php
 
class Product extends Eloquent {
 
    public function store()
    {
        return $this->belongsTo('store');
    }
	
}
