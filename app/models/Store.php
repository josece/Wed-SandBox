<?php
 
class Store extends Eloquent {
 
    public function user()
    {
        return $this->belongsTo('User');
    }
	
}
