@extends('layouts.master')
@section('Header_Script')
	<style>
		.mediaLib div {
			float: left;
			padding: 10px;
			list-style-type:none;
		}
		.mediaLib img {
			width: 100%;
			height: 100%;
		}
		.mediaLibImg:hover .okIcon {
			opacity: 1;
		}
		.mediaLibImgHoverClass {
			-webkit-box-shadow: inset 0 0 2px 3px #fff, inset 0 0 0 7px #5b9dd9;
			box-shadow: inset 0 0 2px 3px #fff, inset 0 0 0 7px #5b9dd9;
			outline: 0;
		}
		.mediaLibImg:hover {
			-webkit-box-shadow: inset 0 0 2px 3px #fff, inset 0 0 0 7px #5b9dd9;
			box-shadow: inset 0 0 2px 3px #fff, inset 0 0 0 7px #5b9dd9;
			outline: 0;
		}
		.okIcon  {
			opacity: 0;
			background: url(/../img/selected.png) no-repeat;
			position: absolute;
			z-index: 999;
			width: 25px;
			height: 24px;
			background-size: contain;
			right: 0;
			top: 0;
			background-color: #e1e1e1;
			-webkit-box-shadow: 0 0 0 1px #fff, 0 0 0 2px #0073aa;
			box-shadow: 0 0 0 1px #fff, 0 0 0 2px #0073aa;
		}
		.gallerySettingGroup div {
			width:100%;
			margin:5px;
		}
		#gallerySettings .nav.nav-pills .nav-item, #gallerySettings .nav.nav-tabs .nav-item {
			width:100%;
		}
		.miniTag {
			padding: 0.2rem;
			margin:2px;
		}
		.mediaLibButton .m-dropzone {
			min-height: 150px;
			background: white;
			padding: 20px 20px;
			display: grid;
		}
		.mediaLibButton:hover {
			display:block!important;
		}
		.featuredRemove:hover {
			opacity:1;
		}
		.featuredRemove {
			opacity:0;
			cursor: pointer;
			position: absolute;
			background-color: #000000a1;
			color: #fff;
			padding: 40px;
			width: 264px;
			min-height: 171px;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
@endsection
@section('content')
	<form method="post" name="pageForm" action="@if(isset($post_title)) {{ route('admin.pageEdit') }} @else {{ route('admin.newPageSave') }} @endif">
	<div class="m-content">

		<div class="row">

			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

					<input class="form-control m-input" type="text" placeholder="Başlığı buraya girin..." name="title" id="example-text-input" @if(isset($post_title))value="{{ $post_title }}"@endif>
				@if(isset($post_id)) <input type="hidden" name="post_id" value="{{ $post_id }}"/> @endif

				<div class="m-portlet">
					<div class="summernote"></div>
				</div>

					<div class="m-portlet">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Form Kodu Ekle
									</h3>
									</div>
								</div>
							</div>

						<div class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body p-10">
								<div class="form-group">
									<textarea class="form-control" rows="5" name="userForm" id="userForm" placeholder="Şimdilik, hazır form kodu içindir...">@if(isset($userForm)) {{ $userForm }} @endif</textarea>
								</div>
							</div>
						</div>
					</div>

			</div>

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									@if(isset($post_title)) Güncelle @else Yayımla @endif
								</h3>
							</div>
						</div>
					</div>
					<!--begin::Form-->
					<div class="m-form m-form--fit m-form--label-align-right">
						<div class="m-portlet__body">
							<a href="">
							<button type="button" class="btn btn-secondary  btn-block">
							<i class="m-menu__link-icon flaticon-visible"></i>
							<span class="m-menu__link-text">
												<b>Görünürlük:</b> Herkeze Açık
							</span>
							</button>
							</a>
							<br/>
							<a href="">
							<button type="button" class="btn btn-secondary  btn-block">

								<i class="m-menu__link-icon flaticon-file-1"></i>
								<span class="m-menu__link-text">
													<b>Taslak Olarak Kaydet</b>
								</span>

							</button>
							</a>
							<br/>
							<a href="">
							<button type="button" class="btn btn-secondary  btn-block">

									<i class="m-menu__link-icon flaticon-interface-5"></i>
								<span class="m-menu__link-text">
													<b>Önizleme</b>
								</span>
							</button>
							</a>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions m-form__actions">
								<div class="row">
									<div class="col-lg-6">
										<a href="javascript:;"  class="btn m-btn--pill m-btn--air btn-outline-danger">
											Çöp
										</a>
										</div>
									<div class="col-lg-6">
										<button class="pageSave btn m-btn--pill m-btn--air btn-focus" type="button">
											@if(isset($post_title)) Güncelle @else Yayımla @endif
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Kapak Görseli
								</h3>
							</div>
						</div>
					</div>
					<!--begin::Form-->
					<div class="m-form m-form--fit m-form--label-align-right mediaLibButton">
							<div class="m-dropzone " id="m-dropzone-one">
								@if(!empty($post_featured))
									<img src="{{ asset('images/full_size/'.$post_featured ) }}" class="img-fluid">
									<input type="hidden" name="featured" value="{{ $post_featured_id }}"/>
									<div class="featuredRemove" style="cursor:pointer;">Öne Çıkan Görseli Kaldır</div>
								@else
								<div class="m-dropzone__msg dz-message needsclick">
									<h3 class="m-dropzone__msg-title">
										Yüklemek İçin Buraya Tıkla
									</h3>
										<span class="m-dropzone__msg-desc">
											Kapak için tek bir .jpg, .jpeg veya .png dosyası seçiniz! max: 8 mb
										</span>
								</div>
								@endif
						</div>
					</div>
					<!--end::Form-->
				</div>

			</div>
		</div>

		<div id="mediaLib"></div>

	</div>
	</form>

	<!-- Begin Gallery Modal -->
	<div class="modal fade" id="m_modal_gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						Görsel Belirle
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="gallerySettings">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">
										<i class="la flaticon-folder-1 m--font-danger"></i>
										Dosya'dan Seç
									</a>
								</li>
								<li class="nav-item"  style="margin-left: 0px;">
									<a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
										<i class="la la-cloud-download m--font-danger"></i>
										Url'den Aktar
									</a>
								</li>
								<li class="nav-item"  style="margin-left: 0px;">
									<a class="nav-link getButton" data-toggle="tab" href="#m_tabs_1_3">
										<i class="la flaticon-add m--font-danger"></i>
										Ortam Kütüphanesi
									</a>
								</li>
							</ul>
							<div class="gallerySettingGroup"></div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<div class="tab-content">
								<div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
									<div class="center-block">
									<strong>Yüklemek İstediğiniz Dosyayı Seçin <span id="photoCounter"></span></strong><br />
										<form class="m-dropzone dropzone m-dropzone--primary" action="{{ URL::Route('admin.upload-post') }}" id="m-dropzone-two">
											<meta name="csrf-token" content="{{ csrf_token() }}">
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
									<span class="small-note">Yüklenebilecek en büyük dosya boyutu: 8 MB.</span>
										<div class="dropzone-previews" id="dropzonePreview"></div>
									</div>

								</div>
								<div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
									<form action="/upload" method="POST">
										<div class="row m--padding-10">
											<div class="col-md-12">
												<div class="btn-group" data-toggle="buttons">
													<label class="mediaSelector btn m-btn--pill m-btn--air         btn-primary active">
														<input type="radio" name="options[]" id="option1" autocomplete="off" checked value="0">
														Fotoğraf
													</label>
													<label class="mediaSelector btn m-btn--pill m-btn--air         btn-info">
														<input type="radio" name="options[]" id="option2" autocomplete="off" value="1">
														Video
													</label>
												</div>
											</div>
										</div>
										<div class="row m--padding-10">
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 m--padding-left-0">
												<input class="form-control m-input" type="text" placeholder="Bir medya url'si girin!" name="mediaUrl" id="url-input">
											</div>
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 m--padding-left-0">
												<a href="javascript:void(0);" class="mediaUrlGet btn btn-secondary btn-md m-btn m-btn m-btn--icon">
													<span>
														<i class="flaticon-download"></i>
														<span>
															Getir
														</span>
													</span>
												</a>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
									<div id="mediaLib">
										<div class="mediaLib">
											<div class="row">

											</div>
											<div class="getButton"><a href="javascript:void(0)">Daha Fazla Görüntüle</a></div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>



				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Kapat
					</button>
					<button type="button" class="btn btn-primary">
						Kaydet
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Gallery Modal -->

@stop

@section('Footer_Script')
	<script src="{{ asset('js/summernote.js') }}" type="text/javascript"></script>
	<script>
	$(document).ready(function(){

		@if(isset($post_content))
		$('.summernote').summernote('code', "{!! preg_replace("/\s+/", " ", trim($post_content)) !!}");

		@endif


		$('input[name=name]').keypress(function (e) {
			if (e.which == 13) {
				ajaxPost($(this).parents('form').attr('action'),postAction,$(this).parents("form").serialize());

				formClear($(this));
				return false;    //<---- Add this line
			}
		});
	});

	function fileuploadSuccessFn(file,done) {
		$('.nav-tabs a[href="#m_tabs_1_3"]').tab('show');
		$('.mediaLibImg').removeClass('mediaLibImgHoverClass');
		$('.okIcon').css({'opacity':0});
		$('.gallerySettingGroup').html('');
		$('.mediaLib').children('.row').html('');
		$('input[name="mediaUrl"]').val('');
		mediaGalleryShow();

		var secici = file.previewElement.querySelectorAll("[data-dz-remove]");
		$(secici).attr('removeid',done.filename);
		$('.alert-dismissible').addClass('show');
		$('.dataMsg').html('Fotoğraflar Yüklendi.');
		setTimeout(alertHide, 5000);
	}

	$(document).on('click', '.pageSave', function(e) {

		var content = $('.summernote').summernote('code');

		ajaxPost($(this).parents('form').attr('action'),pageSave,$(this).parents("form").serialize()+'&content='+content);


		//location.reload();
	});

	function pageSave(data) {

	}


		$(document).on('click', '.tagSave', function(e) {
			ajaxPost($(this).parents('form').attr('action'),postAction,$(this).parents("form").serialize());

			formClear($(this));
		});

		function postAction(data) {
			var tagname = data.tag;
			var tagid = data.tagid;
			$('#tagForm').append('<div data-id="'+tagid+'" class="btn btn-info miniTag">'+tagname+'</div>');
		}

		$(document).on('click','.miniTag', function() {
			$(this).remove();
		});


	</script>
@endsection
