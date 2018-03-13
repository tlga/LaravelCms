@extends('layouts.master')
@section('Header_Script')
	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<style>
		table.dataTable.select tbody tr,
		table.dataTable thead th:first-child {
			cursor: pointer;
		}
		.selectedSetting button {
			padding: 0.15rem 0.3rem!important;
			margin:5px;
		}
	</style>
@endsection
@section('content')

	<div class="m-content">
			<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<form method="POST" action="{{ URL::Route('admin.saveCategory') }}">
								<meta name="csrf-token" content="{{ csrf_token() }}">
									<div class="m-portlet m-portlet--tab">
										<div class="m-portlet__head">
											<div class="m-portlet__head-caption">
												<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
													<h3 class="m-portlet__head-text">
														Yeni Kategori Ekle
													</h3>
												</div>
											</div>
										</div>
										<!--begin::Form-->
										<div class="m-form m-form--fit m-form--label-align-right">
											<div class="m-portlet__body">

												<div class="form-group m-form__group">
													<label for="exampleInputEmail1">
														Kategori Adı
													</label>
													<input type="text" class="form-control m-input" id="categoryName" name="name" aria-describedby="text" placeholder="Kategori adı giriniz">
													<span class="m-form__help">
														Sitenizde görünmesini istediğiniz isim.
													</span>
												</div>

												<div class="form-group m-form__group">
													<label for="exampleSelect1">
														Ebeveyn Kategori
													</label>
													<select class="form-control m-input" id="exampleSelect1" name="parent">
														<option value="0">
															Hiçbiri
														</option>

													</select>
													<span class="m-form__help">
														Kategorileriniz hiyerarşik yapıda olabilir.
													</span>
												</div>

												<div class="form-group m-form__group">
													<label for="exampleTextarea">
														Kategoriyi Tanımla
													</label>
													<textarea class="form-control m-input" id="exampleTextarea" rows="3" name="description"></textarea>
													<span class="m-form__help">
															Bu genelde kategori sayfası görüntülenirken arama motorlarına gösterilir.
													</span>
												</div>

												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<button type="button" class="btn btn-primary postButton">
															Yeni Kategori Ekle
														</button>
													</div>
												</div>

											</div>
										</div>
									</div>
							</form>
						</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<div class="m-portlet m-portlet--tab">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
									<h3 class="m-portlet__head-text">
										Kategoriler
										{{--@foreach($categories as $category)
											<li>
												{{ $category->name }}
												@if(count($category->childs))
													@include('panel.child',['childs' => $category->childs])
												@endif
											</li>
										@endforeach--}}

									</h3>
								</div>
							</div>
						</div>
						<!--begin::Form-->
						<div class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body">
								<div class="form-group m-form__group">
									<select class="form-control m-input" id="exampleSelect1" name="batch">
										<option value="0">
											Toplu İşlem
										</option>
										<option value="1" class="removeSelectedRows">Seçilenleri Sil</option>
									</select>
								</div>

									<table id="categoryTable" class="display select table-hover table-condensed" cellspacing="0" width="100%">
										<thead>
										<tr>
											<th><input name="select_all" value="1" type="checkbox"></th>
											<th>Adı</th>
											<th>Açıklama</th>
											<th>Toplam</th>
										</tr>
										</thead>
									</table>

								<form name="tableForm" id="tableForm">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>

@stop

@section('Footer_Script')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">



		$(document).on('click','.postButton', function() {
			$('select[name=parent]').html('<option value="0">Hiçbiri</option>');
			ajaxPost('getContent/category',getCategory);
		});


		function getCategory(data) {
			var parent = $('select[name=parent]');
			for(var i = 0; i < data.length; i++) {

				parent.append('<option value="'+ data[i].id +'">'+ data[i].name +'</option>');
			}

			reloadDatatable('#categoryTable');

		}



		confirmButton('select[name=batch]','post/deleteCategory',deleteCategory);

	//
	// Updates "Select all" control in a data table
	//
	//table.ajax.reload();



	function updateDataTableSelectAllCtrl(table){


	var $table             = table.table().node();
	var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
	var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
	var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

	// If none of the checkboxes are checked
	if($chkbox_checked.length === 0){
	chkbox_select_all.checked = false;
	if('indeterminate' in chkbox_select_all){
	chkbox_select_all.indeterminate = false;
	}

	// If all of the checkboxes are checked
	} else if ($chkbox_checked.length === $chkbox_all.length){
		$('#categoryTable').find('.selectedSetting').remove();
	chkbox_select_all.checked = true;
	if('indeterminate' in chkbox_select_all){
	chkbox_select_all.indeterminate = false;
	}

	// If some of the checkboxes are checked
	} else {

	chkbox_select_all.checked = true;
	if('indeterminate' in chkbox_select_all){
	chkbox_select_all.indeterminate = true;
	}
	}

	}



	$(document).ready(function (){
		ajaxPost('getContent/category',getCategory);

		/*DataTable*/
	// Array holding selected row IDs
	var rows_selected = [];
	var table = $('#categoryTable').DataTable({
	'processing': true,
	'serverSide': false,
	'serverPaging': true,
	'serverFiltering': true,
	'serverSorting': true,
	'select': true,
	'saveState': {
		cookie: true,
		webstorage: true
	},
		'colReorder': {
			realtime: true
		},
	'language': {
		'lengthMenu': 'Sayfa başına _MENU_ gösterilen öge',
		'zeroRecords': 'Öge bulunamadı - üzgünüz',
		'info': 'Sayfa _PAGE_ den _PAGES_ kadar gösteriliyor',
		'infoEmpty': 'Hiç bir kayıt bulunamadı',
		'infoFiltered': '(Filtreleniyor _MAX_ toplam kayıttan)',
		"loadingRecords": "Yükleniyor...",
		"processing":     "İşleniyor...",
		"search":         "Arama:",
		"paginate": {
			"first":      "İlk",
			"last":       "Son",
			"next":       "İleri",
			"previous":   "Geri"
		},
		"aria": {
			"sortAscending":  ": Düz sıralama",
			"sortDescending": ": Tersten sıralama"
		}
	},
	'ajax': '{{ route('admin.datatable.getCategory') }}',
	'columns': [
		{name: 'name'},
		{data: 'name', name: 'name'},
		{data: 'description', name: 'description'},
		{data: 'count', name: 'count'},
	],
	'columnDefs': [{
		'targets': 0,
		'searchable': false,
		'orderable': false,
		'width': '1%',
		'className': 'dt-body-center',
		'render': function (data, type, full, meta){
		return '<input type="checkbox">';
		}
	}
	],
	'order': [[1, 'asc']],
	'rowCallback': function(row, data, dataIndex){

		//Get Data-id all Rows
		$(row).attr('data-id',data.id);

	// Get row ID
	var rowId = data[0];


	// If row ID is in the list of selected row IDs
	if($.inArray(rowId, rows_selected) !== -1){

	/*$(row).find('input[type="checkbox"]').prop('checked', true);
	$(row).addClass('selected');*/
	}
	}
	});

	// Handle click on checkbox
	$('#categoryTable tbody').on('click', 'input[type="checkbox"]', function(e){
	var $row = $(this).closest('tr');

		// Get row data
	var data = table.row($row).data();

	// Get row ID
	var rowId = data[0];



	// Determine whether row ID is in the list of selected row IDs
	var index = $.inArray(rowId, rows_selected);

	// If checkbox is checked and row ID is not in list of selected row IDs
	if(this.checked && index === -1){
	rows_selected.push(rowId);

	// Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
	} else if (!this.checked && index !== -1){
	rows_selected.splice(index, 1);
	}

	if(this.checked){
		var dataId = $row.attr('data-id');
	$row.addClass('selected');
		if($('.selected').length < 2) {
			$row.find('.sorting_1').append('<div class="selectedSetting"><button type="button" class="btn btn-outline-danger m-btn m-btn--custom m-btn--outline-2x removeSelectedRows" data-id="'+dataId+'"><i class="fa fa-remove"></i></button><button type="button" class="btn btn-outline-info m-btn m-btn--custom m-btn--outline-2x"><i class="fa fa-pencil"></i> </button></div>');


		} else {
			$row.find('.selectedSetting').remove();
		}

	} else {
	$row.removeClass('selected');
	$row.find('.selectedSetting').remove();
	}
		if($('.selected').length > 1) {
			$('#categoryTable').find('.selectedSetting').remove();
		}


		// Update state of "Select all" control
	updateDataTableSelectAllCtrl(table);
	// Prevent click event from propagating to parent
	e.stopPropagation();
	});

	// Handle click on table cells with checkboxes
	$('#categoryTable').on('click', 'tbody td, thead th:first-child', function(e){
	$(this).parent().find('input[type="checkbox"]').trigger('click');
	});

	// Handle click on "Select all" control
	$('thead input[name="select_all"]', table.table().container()).on('click', function(e){

	if(this.checked){
	$('#categoryTable tbody input[type="checkbox"]:not(:checked)').trigger('click');
	} else {
	$('#categoryTable tbody input[type="checkbox"]:checked').trigger('click');
	}

	// Prevent click event from propagating to parent
	e.stopPropagation();
	});

	});

		$(document).on('click','.removeSelectedRows', function() {
			//confirmButton('select[name=batch]','post/deleteCategory',deleteCategory);
			var value = $(this).attr('data-id');
			$('#confirmModal').modal('show');
			$('.confirm').attr('selected-id',value);

		});
		$(document).on('click','.confirm',function() {
			var value = $(this).attr('selected-id');
			$('#tableForm').append('<input type="hidden" name="selectedRows[]" value="'+ value +'">');
			ajaxPost('post/deleteCategory',deleteCategory,$('form#tableForm').serialize());
			$('#tableForm').find('input[name="selectedRows[]"]').remove();

			//$( "input[name='select_all']:not(:checked)" );

		});

	</script>
@endsection
