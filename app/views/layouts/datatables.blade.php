@section('stylesheets')
	{{ HTML::style('assets/css/datatables.css') }}
@stop
@section('scripts')
    {{ HTML::script('assets/js/vendor/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/js/vendor/dataTables.foundation.js') }}
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    $('.datatable').dataTable({
    	"language": {
           "emptyTable":     "{{Lang::get('datatables.emptyTable')}}",
           "info":           "{{Lang::get('datatables.info')}}",
           "infoEmpty":      "{{Lang::get('datatables.infoEmpty')}}",
           "infoFiltered":   "{{Lang::get('datatables.infoFiltered')}}",
           "infoPostFix":    "{{Lang::get('datatables.infoPostFix')}}",
           "thousands":      "{{Lang::get('datatables.thousands')}}",
           "lengthMenu":     "{{Lang::get('datatables.lengthMenu')}}",
           "loadingRecords": "{{Lang::get('datatables.loadingRecords')}}",
           "processing":     "{{Lang::get('datatables.processing')}}",
           "search":         "{{Lang::get('datatables.search')}}",
           "zeroRecords":    "{{Lang::get('datatables.zeroRecords')}}",
           "paginate": {
                "first":      "{{Lang::get('datatables.paginate--first')}}",
                "last":       "{{Lang::get('datatables.paginate--last')}}",
                "next":       "{{Lang::get('datatables.paginate--next')}}",
                "previous":   "{{Lang::get('datatables.paginate--previous')}}",
            },
            "aria": {
                "sortAscending":  "{{Lang::get('datatables.aria--sortAscending')}}",
                "sortDescending": "{{Lang::get('datatables.aria--sortDescending')}}"
    		}
        }
    });

} );
</script>
@stop