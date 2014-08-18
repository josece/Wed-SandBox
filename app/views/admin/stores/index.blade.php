@include('layouts.datatables')
<div class="row">
	<div class="large-12 columns">

		<h2>{{Lang::get('stores.store--title')}}</h2>
			{{ HTML::link('admin/store/new', Lang::get('stores.store--new'), array('class' => 'button small') )}}
		
		@if($stores->isEmpty())
			<div class="margin--top">
				{{Lang::get('stores.store--none')}}</div>
		@else
		<br />&nbsp;<br />
		<table class="margin--top datatable" width="100%">
			<thead>
				<tr>
					<th>{{Lang::get('form.id')}}</th>
					<th>{{Lang::get('stores.store--name')}}</th>
					<th>{{Lang::get('form.actions')}}</th>
					<th>{{Lang::get('form.actions')}}</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($stores as $store)

				<tr>
					<td>{{$store->id}}</td>
					<td>{{$store->name}}</td>
					
					<td>{{HTML::Link('admin/store/' . $store->permalink.'/edit', Lang::get('form.edit'), array('class'=>'button tiny message'))}}</td>
					<td>{{HTML::Link('admin/store/' . $store->permalink, Lang::get('form.view'), array('class'=>'button tiny success'))}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>