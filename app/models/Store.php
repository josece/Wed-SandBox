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
			return "false";
		}
		if (is_numeric($store_id)) {
			$store = $query->findOrFail($store_id);
		} else {
       		$store = $query->where('permalink', '=', $store_id)->firstOrFail();
   		}
   			//let's check the access 
   			$user = Auth::user();
   			if( $store->user_id != $user->id && !$user->hasRole('admin'))
   				return "false";
   		return $store;
	}

	/*
	* Determines if a user has access to edit store information
	* @param store_number_id
	* @return boolean
	*
	public function scopeUserHasAccessToStore($query, $store_number_id = null){
		$user = Auth::user();
		$store = Store::find($store_number_id);
		//if the store owner is not the same as the sessions and is not the admin
		if( $store->user_id != $user->id 
			&& !$user->hasRole('admin'))
			return "false";
		return "true";
	}*/
}
