<?php
 $array = array(); 
//on select one, call ajax for its sons.
 ?>

 <div class="medium-4 columns">
 	@foreach (Taxonomy::getfromparent($parent) as $category)
 	<?php $array = array_add($array, $category->id , $category->name); ?>
 	@endforeach
 	{{Form::select('parent', $array)}}
 </div>

