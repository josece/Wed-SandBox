<?php
/*
 * @author Jose Calleja Esnal
 * 
 * 3 de julio de 2014
 */

class CategoriesController extends \BaseController {

	protected $layout = "layouts.main";
	public function __construct(){
		//
	}
	
	public function index(){
		//
	}

/* Admin functions */
	public function getNew(){
		$this->layout->title = Lang::get('categories.store--new') ;
		$this->layout->content = View::make('admin.categories.new');
	}

	public function postNew() {
		$validator = Validator::make(Input::all(),array('name' => 'required'));
		if($validator->passes()){
			$category = New Taxonomy;
			$category->name = Input::get('name');
			$category->description = Input::get('description');
			$category->type = 'Product_category';
			$category->permalink = $this->generateTaxonomySlug($category->name);
			$category->save();
			return Redirect::to('admin/categories/new')->withSuccess(Lang::get('stores.success--add'));
		}

	}

	public function generateTaxonomySlug($taxonomy_name) {
		$slug = Str::slug($taxonomy_name); //first make the name safe for a URL
		$slugCount = 0; //now count how many have the same slug structure
		$slugCount = count( Taxonomy::whereRaw("permalink REGEXP '^{$slug}(-[0-9]*)?$'")->get());
		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug; //return original if its the only one
	}
}