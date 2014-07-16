@section('stylesheets')
	{{ HTML::style('assets/css/datatables.css') }}
@stop
@section('scripts')
    {{ HTML::script('assets/js/vendor/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/js/vendor/dataTables.foundation.js') }}
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    $('#jose').dataTable({
    	"language": {
            "lengthMenu": "{{Lang::get('datatables.lengthMenu')}}",
            "zeroRecords": "{{Lang::get('datatables.zeroRecords')}}",
            "info": "{{Lang::get('datatables.info')}}",
            "infoEmpty": "{{Lang::get('datatables.infoEmpty')}}",
            "infoFiltered": "{{Lang::get('datatables.infoFiltered')}}",
            "search": "{{Lang::get('datatables.search')}}",            
            "paginate": {
        	"first":     "{{Lang::get('datatables.paginate--first')}}",
       		"last":      "{{Lang::get('datatables.paginate--last')}}",
        	"next":       "{{Lang::get('datatables.paginate--next')}}",
        	"previous":   "{{Lang::get('datatables.paginate--previous')}}",
    		},
        }
    });

} );
</script>
@stop<div class="row">
	<div class="large-12 columns">

		<h2>{{Lang::get('stores.store--title')}}</h2>
			{{ HTML::link('admin/store/new', Lang::get('stores.store--new'), array('class' => 'button small') )}}
		@if($stores->isEmpty())
			<div class="margin--top">
				{{Lang::get('stores.store--none')}}</div>
		@else
		<br />&nbsp;<br />
		<table class="margin--top" id="jose" width="100%">
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
					
					<td>{{HTML::Link('admin/store/' . $store->id.'/edit', Lang::get('form.edit'), array('class'=>'button tiny message'))}}</td>
					<td>{{HTML::Link('admin/store/' . $store->id, Lang::get('form.view'), array('class'=>'button tiny success'))}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>