@extends('layouts.master')
@section('Header_Script')

	<style>
		.actions span {
			color: #fff;
			background-color: #5867dd;
			border-color: #5867dd;
			margin: 2px;
			padding: 1px;
			max-width: 170px;
			cursor: pointer;
			display:block;
		}
		.actions span:hover {
			background-color: #3e4d9a
		}
	</style>

@endsection
@section('content')
	<div class="row">

		<div class="col-md-6">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text" style="text-transform:capitalize;">
								Dosya Yükle
							</h3>

						</div>
					</div>
				</div>


					<div class="m-form m-form--fit m-form--label-align-right">
						<div class="m-portlet__body p-10">

									<div class="center-block">
										<strong>Yüklemek İstediğiniz Dosyayı Seçin <span id="photoCounter"></span></strong><br />
										<form class="m-dropzone dropzone m-dropzone--primary" action="{{ URL::Route('upload-post') }}" id="m-dropzone-two">
											<meta name="csrf-token" content="{{ csrf_token() }}">
											<input type="hidden" name="archive" value="1">
											<div class="m-dropzone__msg dz-message needsclick">
												<h3 class="m-dropzone__msg-title">
													Öge Seçin
												</h3>
													<span class="m-dropzone__msg-desc">
														Sürekle & Bırak veya Tıkla & Seç
													</span>
											</div>
										</form>
										<br />
										<span class="small-note">Kabul edilen dosya uzantıları: png, gif, jpeg, jpg, zip, rar, pdf, doc, docx, xls, xlsx, psd <br /> Yüklenebilecek en büyük dosya boyutu: 8 MB.</span>
										<div class="dropzone-previews" id="dropzonePreview"></div>
									</div>

							</div>
						</div>
					</div>
			</div>

		<div class="col-md-6">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Dosya Tanımla
							</h3>
						</div>
					</div>
				</div>

				<div class="m-form m-form--fit m-form--label-align-right">
					<div class="m-portlet__body p-10">
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Dosya</th>
								<th scope="col">Fonksiyon</th>
							</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">
				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Yüklenmiş Dosyalar
								</h3>
							</div>
						</div>
					</div>

					<div class="m-form m-form--fit m-form--label-align-right">
						<div class="m-portlet__body p-10">
							<table class="table table-hover">
								<thead>
								<tr>
									<th scope="col">Dosya</th>
									<th scope="col">Fonksiyon</th>
									<th scope="col">İşlem</th>
								</tr>
								</thead>
								<tbody>
								@if(isset($uploadedFile))
								@foreach($uploadedFile as $image)
									<tr>
										<td>
											<a href="{{ asset('/images/user_upload/'.$image->filename) }}" target="_blank">
												<img src="{{ asset('img/document_version.png') }}" width="100px" height="130px"/>
												<br /> Id: {{ $image->id }} <br />
												Dosya Adı: {{ $image->filename }}
											</a>
										</td>
										<td>
											<div class="actions">
												<span class="sinavtakvimi" @if($image->setting == 4) style="background-color:green;" @endif>Sınav Takvimi</span>
												<span class="sinavsonuclari" @if($image->setting == 5) style="background-color:green;" @endif>Sınav Sonuçları</span>
												<span class="yillikcalismatakvimi" @if($image->setting == 6) style="background-color:green;" @endif>Yıllık Çalışma Takvimi</span>
												<span class="dersprogrami" @if($image->setting == 7) style="background-color:green;" @endif>Ders Programı</span>
												<span class="aylikbulten" @if($image->setting == 8) style="background-color:green;" @endif>Aylık Bülten</span>
												<span class="aylikyemeklistesi" @if($image->setting == 9) style="background-color:green;" @endif>Aylık Yemek Listesi</span>
												<span class="bursluluk" @if($image->setting == 10) style="background-color:green;" @endif>Bursluluk Sınav Sonuçları</span>
											</div>
										</td>
										<td>
											<div class="btn btn-danger fileDelete" data-id="{{ $image->id }}"><i class="fa fa-remove"></i> Sil</div>
										</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>

<div class="sablonHidden" style="display:none">
	<div class="cols1">
		<a href="" target="_blank"><img src="{{ asset('img/document_version.png') }}" width="100px" height="130px"/></a>
	</div>
	<div class="cols2">
		<div class="actions">
			<span class="sinavtakvimi">Sınav Takvimi</span>
			<span class="sinavsonuclari">Sınav Sonuçları</span>
			<span class="yillikcalismatakvimi">Yıllık Çalışma Takvimi</span>
			<span class="dersprogrami">Ders Programı</span>
			<span class="aylikbulten">Aylık Bülten</span>
			<span class="aylikyemeklistesi">Aylık Yemek Listesi</span>
			<span class="bursluluk">Bursluluk Sınav Sonuçları</span>
		</div>
	</div>
</div>


@stop

@section('Footer_Script')
<script type="text/javascript">

	function fileuploadSuccessFn(file,done) {

		$('.cols2').find('span').attr('data-id',done.id);
		$('.cols1').find('a').append('<br />Id: '+done.id+'<br />Dosya Adı: '+done.filename);

		var newRow = $("<tr>");
		var cols = "";
		var cols1 = $('.cols1').html();
		var cols2 = $('.cols2').html();



		cols += '<td>'+cols1+'</td>';
		cols += '<td>'+cols2+'</td>';
		newRow.append(cols);

		$("table.table").append(newRow);




		var secici = file.previewElement.querySelectorAll("[data-dz-remove]");
		$(secici).attr('removeid',done.filename);
		$('.alert-dismissible').addClass('show');
		$('.dataMsg').html('Dosya Yüklendi.');
		setTimeout(alertHide, 5000);
	}

	$(document).on('click','.table span', function() {
			var type = $(this)[0].className;
			var dataId = $(this)[0].attributes[1]['nodeValue'];
			$(this).css({'background-color':'green'});
		ajaxPost('{{ route('admin.uploadSelect') }}',fnSelect,'id='+dataId+'&type='+type);

	});

	$(document).on('click','.fileDelete', function() {
			var dataId = $(this)[0].attributes[1]['nodeValue'];
			$(this).parents('tr').remove();
		ajaxPost('{{ route('admin.uploadDelete') }}',fnSelect,'id='+dataId);

	});

	function fnSelect(data) {
		console.log('Atama tamamlandı!');
	}

	function pageSave(data) {
		console.log('mission complete');
	}

	$(document).ready(function(){
		$(document).on('click', '.pageSave', function(e) {

			var content = $('.summernote').summernote('code');

			ajaxPost($(this).parents('form').attr('action'),pageSave,$(this).parents("form").serialize());

			//location.reload();
		});
		@if(isset($userId))
		$(document).on('click', '.pageDelete', function(e) {

			var content = $('.summernote').summernote('code');

			ajaxPost('',pageSave,$(this).parents("form").serialize());

			//location.reload();
		});
		@endif



	});
</script>
@endsection
