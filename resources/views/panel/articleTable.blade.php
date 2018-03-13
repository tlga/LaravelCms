@extends('layouts.master')
@section('Header_Script')

<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection
@section('content')

<div class="m-content">
	<table id="articlesData" class="table table-hover table-condensed" style="width:100%">
		<thead>
		<tr>
			<th>Id</th>
			<th>Yazı Adı</th>
			<th>İşlem</th>
		</tr>
		</thead>
	</table>


</div>

@stop

@section('Footer_Script')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$(document).on('click', '.articleDelete', function(e) {

			ajaxPost($(this).parents('form').attr('action'),articleDelete,$(this).parents("form").serialize());

			$(this).parents('tr').fadeOut();

			//location.reload();
		});

		function articleDelete(data) {

		}


		oTable = $('#articlesData').DataTable({
			"processing": true,
			"serverSide": true,
			"serverPaging": true,
			"serverFiltering": true,
			"serverSorting": true,
			"saveState": {
				cookie: true,
				webstorage: true
			},
			"ajax": "{{ route('admin.datatable.articleData') }}",
			"columns": [
				{data: 'id', name: 'id'},
				{data: 'post_title', name: 'Sayfa Adı'},
				{
					"render": function (data, type, JsonResultRow, meta) {
						return '<a href="{{ route("admin.articleProcess") }}/'+JsonResultRow.id+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
							<i class="la la-edit"></i>\
						</a><form style="display: initial;" action="{{ route("admin.articleDelete") }}/'+JsonResultRow.id+'" method="post"><input type="hidden" name="deleteId" value="'+JsonResultRow.id+'"><span class="articleDelete m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></span></form><a href="{{ route("single") }}/'+JsonResultRow.post_slug+'" target="_blank" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Görüntüle">\
							<i class="la la-eye"></i>\
						</a>';
					}
				},
			],

		});
	});
</script>
@endsection
