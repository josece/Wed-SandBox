<?php
 
class Store extends Eloquent {
 
 	protected $table = 'stores';
	
	/**
	 * Retrieve the User object who owns the current store
	 * @return user [object]
	 */
    public function user() {
        return $this->belongsTo('User');
    }
    
	/**
	 * Retrieve all of the objects that exist within the current store
	 * @return products [object]
	 */
	public function products() {
		return $this->hasMany('Product');
	}

	/**
	 * Retrieve a store object from its ID or permalink slug
	 * @param store_id | store_slug
	 * @return Store [object]
	 */
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
