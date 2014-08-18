@include('layouts.datatables')
<div class="row">
	<div class="large-12 columns">
		<h2>{{$store->name}}</h2>
		@include('admin.stores.navigation')
		<div class="medium-8 large-9 columns">
			{{ HTML::link('admin/store/'.$store->permalink.'/product/new', Lang::get('stores.product--new'), array('class' => 'button small') )}}
			@if($products->isEmpty())
			<div class="margin--top">
				{{Lang::get('stores.product--none')}}
			</div>
			@else
			<br />&nbsp;<br />
			<table class="margin--top datatable" width="100%">
				<thead>
					<tr>
						<th>{{Lang::get('form.id')}}</th>
						<th>{{Lang::get('products.product--name')}}</th>
						<th>{{Lang::get('products.product--price')}}</th>
						<th>{{Lang::get('form.actions')}}</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($products as $product)

					<tr>
						<td>{{$product->id}}</td>
						<td>{{$product->name}}</td>
						<td>{{$product->price}}</td>

						<td>{{HTML::Link('admin/product/' . $product->id.'/edit', Lang::get('form.edit'), array('class'=>'button tiny message'))}}</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div> 
	</div>
</div>