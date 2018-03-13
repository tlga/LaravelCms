@extends('layouts.master')
@section('Header_Script')

	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

@endsection
@section('content')

	<div class="m-content">
			<table id="imagesData" class="table table-hover table-condensed" style="width:100%">
				<thead>
				<tr>
					<th>Id</th>
					<th>Dosya Adı</th>
					<th>İmages</th>
					<th>İşlem</th>
				</tr>
				</thead>
			</table>


	</div>

@stop

@section('Footer_Script')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).on('click','.removeImg',function() {
			ajaxPost($(this).parents('form').attr('action'),removedImg,$(this).parents("form").serialize());

			$(this).parents('tr').fadeOut();
		});
		function removedImg(data) {

		}
		$(document).ready(function() {




			oTable = $('#imagesData').DataTable({
				"processing": true,
				"serverSide": true,
				"serverPaging": true,
				"serverFiltering": true,
				"serverSorting": true,
				"saveState": {
					cookie: true,
					webstorage: true
				},
				"render": function(url){
					return '<img src="'+url+'"/>';
				},
				"ajax": "{{ route('admin.datatable.getposts') }}",
				"columns": [
					{data: 'id', name: 'id'},
					{data: 'filename', name: 'Dosya Adı'},
					{
						"render": function (data, type, JsonResultRow, meta) {
							if(JsonResultRow.type > 0) {
								var image = url+'/img/document_version.png';
								var archiveUrl = url+'/images/user_upload/'+JsonResultRow.filename;
							} else {
								var image = url+'/images/icon_size/'+JsonResultRow.filename;
								var archiveUrl = url+'/images/icon_size/'+JsonResultRow.filename;
							}
							return '<a href="'+archiveUrl+'" target="_blank"><img src="'+image+'" class="img-responsive" width="150px"></a>';
						}
					},
					{
						"render": function (data, type, JsonResultRow, meta) {
							return '<form action="{{ route('admin.upload-remove') }}" method="post" style="display:initial;"><input type="hidden" name="id" value="'+JsonResultRow.id+'"><button type="button" class="removeImg m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
							<i class="la la-trash"></i>\
						</a></form>';
						}
					},
				],

			});
		});
	</script>
@endsection
