<div class="row">
	<div class="large-12 columns">
		<h2>{{$store->name}}</h2>
	
		<div class="medium-4 large-3 columns">

			<ul class="side-nav">
				<li><a href="#">Productos</a></li>
			</ul>
		</div>
		<div class="medium-8 large-9 columns">
			{{ HTML::link('admin/store/'.$store->id.'/product/new', Lang::get('stores.product--new'), array('class' => 'button small') )}}

		</div> 
	</div>
</div>