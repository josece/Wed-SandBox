<?php
 
class Store extends Eloquent {
 
 	protected $table = 'stores';
	
	/*
	* Definicion de relaciones
	*/
    public function user() {
        return $this->belongsTo('User');
    }
	
	public function products() {
		return $this->hasMany('Product');
	}

	public function scopeGetStore($query, $store_id = null){
		if(is_null($store_id)){
			return false;
		}
		if (is_numeric($store_id)) {
			$store = $query->find($store_id);
		} else {
       		$store = $query->where('permalink', '=', $store_id)->first();
   		}
   		return $store;
	}
}
