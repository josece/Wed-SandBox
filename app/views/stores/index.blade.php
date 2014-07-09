<div class="row">
	<div class="large-12 columns">

		<h2>{{Lang::get('stores.store--title')}}</h2>
			{{ HTML::link('store/new', Lang::get('stores.store--new'), array('class' => 'button small') )}}
		@if($stores->isEmpty())
			<div class="margin--top">
				{{Lang::get('stores.store--none')}}</div>
		@else
		<table class="margin--top">
			<thead>
				<tr>
					<th>{{Lang::get('form.id')}}</th>
					<th>{{Lang::get('stores.store--name')}}</th>
					<th colspan="2">{{Lang::get('form.actions')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($stores as $store)

				<tr>
					<td>{{$store->id}}</td>
					<td>{{$store->name}}</td>
					
					<td>{{HTML::Link('stores/usersedit/' . $store->id, Lang::get('form.edit'), array('class'=>'button tiny message'))}}</td>
					<td>{{-- HTML::Link('admin/users-disable/' . $store->id, Lang::get('form.disable'), array('class'=>'button tiny alert')) --}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif


	</div>
</div>