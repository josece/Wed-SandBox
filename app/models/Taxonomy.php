<?php
 
class Taxonomy extends Eloquent {
 	
 	protected $table = 'taxonomies';

	public function products() {
		return $this->belongsToMany('Taxonomy');
	}

	public function children() {
		return $this->hasMany('Taxonomy', 'parent_id');
	} 

	public function parent() {
		return $this->belongsTo('Taxonomy', 'parent_id');
	}
	public function scopeGetfromparent($query, $parent_id) {
		$categories = $query->whereRaw("parent_id = $parent_id && type= 'Product_category'")->get();
		return $categories;
	}
}