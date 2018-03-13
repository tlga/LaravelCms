@extends('layouts.master')
@section('Header_Script')
	<link href="{{ asset('css/jquery.typeahead.css') }}" rel="stylesheet" type="text/css" />
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
		.typeahead__container {
			max-width: 500px;
		}
	</style>

@endsection
@section('content')
	<div class="row">

	{{--	<form class="navbar-form navbar-left">
			<div class="typeahead__container">
				<div class="typeahead__field">

						<span class="typeahead__query">
								<input class="js-typeahead"
											 name="q"
											 type="search"
											 autofocus
											 autocomplete="off">
						</span>

				</div>
			</div>
		</form>--}}

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
										<strong>Yüklemek İstediğiniz Görseli Seçin <span id="photoCounter"></span></strong><span>(1900px genişliğinden büyük optimize edilmiş görseller tavsiye edilir.)</span><br />
										<form class="m-dropzone dropzone m-dropzone--primary" action="{{ URL::Route('upload-post') }}" id="m-dropzone-two">
											<meta name="csrf-token" content="{{ csrf_token() }}">
											<input type="hidden" name="type" value="3">
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
								Slider Görseli
							</h3>
						</div>
					</div>
				</div>

				<div class="m-form m-form--fit m-form--label-align-right">
					<div class="m-portlet__body p-10">
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Görsel</th>
								<th scope="col">Ayarlar</th>
								<th scope="col">İşlem</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="sliderTemp">

								</td>
								<td class="sliderSetting">

								</td>
								<td class="process">

								</td>
							</tr>
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
									Mevcut Sliderlar
								</h3>
							</div>
						</div>
					</div>

					<div class="m-form m-form--fit m-form--label-align-right">
						<div class="m-portlet__body p-10">
							<table class="table table-hover">
								<thead>
								<tr>
									<th scope="col">Görsel</th>
									<th scope="col">Ayarlar</th>
									<th scope="col">İşlem</th>
								</tr>
								</thead>
								<tbody>
									@foreach($slider as $sliders)
									<tr>
										<td>
											<a href="{{ asset('images/full_size/'.\App\Logic\Functions\Functions::getImage($sliders->image_id)) }}" target="_blank"><img src="{{ asset('images/icon_size/'.\App\Logic\Functions\Functions::getImage($sliders->image_id)) }}" width="150px" class="img-responsive"/></a>
										</td>
										<td>
											<input type="text" class="form-control" name="order_no" placeholder="Sıra numarası ?" value="{{ $sliders->order_no }}">
											<input type="text" class="form-control" name="link" placeholder="Bağlantı Ara" value="{{ $sliders->link }}">
										</td>
										<td>
											<div class="btn btn-danger fileDelete" data-id="{{ $sliders->id }}">
												<i class="fa fa-remove"></i> Sil
											</div>
											<div class="btn btn-success fileUpdate" data-id="{{ $sliders->id }}">
												<i class="fa fa-check"></i> Güncelle
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>
@stop

@section('Footer_Script')
	{{--<script src="{{ asset('js/jquery.typeahead.js') }}" type="text/javascript"></script>--}}

	{{--<script>

		var data = {
			"post": [
				"Affligem Blonde", "Amsterdam Big Wheel", "Amsterdam Boneshaker IPA", "Amsterdam Downtown Brown", "Amsterdam Oranje Summer White",
				"Anchor Liberty Ale", "Beaus Lug Tread Lagered Ale", "Beerded Lady", "Belhaven Best Ale", "Big Rock Grasshopper Wheat",
				"Big Rock India Pale Ale", "Big Rock Traditional Ale", "Big Rock Warthog Ale", "Black Oak Nut Brown Ale", "Black Oak Pale Ale",
				"Boddingtons Pub Ale", "Boundary Ale", "Caffreys", "Camerons Auburn Ale", "Camerons Cream Ale", "Camerons Rye Pale Ale", "Ceres Strong Ale",
				"Cheval Blanc", "Crazy Canuck Pale Ale", "Creemore Springs Altbier", "Crosswind Pale Ale", "De Koninck", "Delirium Tremens",
				"Erdinger Dunkel Weissbier", "Erdinger Weissbier", "Export", "Flying Monkeys Amber Ale", "Flying Monkeys Antigravity",
				"Flying Monkeys Hoptical", "Flying Monkeys Netherworld", "Flying Monkeys Smashbomb", "Fruli", "Fullers Extra Spec Bitter",
				"Fullers London Pride", "Granville English Bay Pale", "Granville Robson Hefeweizen", "Griffon Pale Ale", "Griffon Red Ale",
				"Hacker-Pschorr Hefe Weisse", "Hacker-Pschorr Munchen Gold", "Hockley Dark Ale", "Hoegaarden", "Hops & Robbers IPA", "Houblon Chouffe",
				"James Ready Original Ale", "Kawartha Cream Ale", "Kawartha Nut Brown Ale", "Kawartha Premium Pale Ale", "Kawartha Raspberry Wheat",
				"Keiths", "Keiths Cascade Hop Ale", "Keiths Galaxy Hop Ale", "Keiths Hallertauer Hop Ale", "Keiths Hop Series Mixer",
				"Keiths Premium White", "Keiths Red", "Kilkenny Cream Ale", "Konig Ludwig Weissbier", "Kronenbourg 1664 Blanc", "La Chouffe",
				"La Messager Red Gluten Free", "Labatt 50 Ale", "Labatt Bass Pale Ale", "Lakeport Ale", "Leffe Blonde", "Leffe Brune",
				"Legendary Muskoka Oddity", "Liefmans Fruitesse", "Lions Winter Ale", "Maclays", "Mad Tom IPA", "Maisels Weisse Dunkel",
				"Maisels Weisse Original", "Maredsous Brune", "Matador 2.0 El Toro Bravo", "Mcauslan Apricot Wheat Ale", "Mcewans Scotch Ale",
				"Mill St Belgian Wit", "Mill St Coffee Porter", "Mill St Stock Ale", "Mill St Tankhouse Ale", "Molson Stock Ale", "Moosehead Pale Ale",
				"Mort Subite Kriek", "Muskoka Cream Ale", "Muskoka Detour IPA", "Muskoka Harvest Ale", "Muskoka Premium Dark Ale", "Newcastle Brown Ale",
				"Niagaras Best Blonde Prem", "Okanagan Spring Pale Ale", "Old Speckled Hen", "Ommegang Belgian Pale Ale", "Ommegang Hennepin", "PC IPA",
				"Palm Amber Ale", "Petrus Blonde", "Petrus Oud Bruin Aged Red", "Publican House Ale", "Red Cap", "Red Falcon Ale", "Rickards Dark",
				"Rickards Original White", "Rickards Red", "Rodenbach Grand Cru", "Schofferhofer Hefeweizen", "Shock Top Belgian White",
				"Shock Top Raspberry Wheat", "Shock Top Variety Pack", "Sleeman Cream Ale", "Sleeman Dark", "Sleeman India Pale Ale", "Smithwicks Ale",
				"Spark House Red Ale", "St. Ambroise India Pale Ale", "St. Ambroise Oatmeal Stout", "St. Ambroise Pale Ale", "Stereovision Kristall Wheat",
				"Stone Hammer Dark Ale", "Sunny & Share Citrus Saison", "Tetleys English Ale", "Thirsty Beaver Amber Ale", "True North Copper Altbier",
				"True North Cream Ale", "True North India Pale Ale", "True North Strong", "True North Wunder Weisse", "Twice As Mad Tom IPA",
				"Unibroue La Fin Du Monde", "Unibroue Maudite", "Unibroue Trois Pistoles", "Upper Canada Dark Ale", "Urthel Hop-It Tripel IPA",
				"Waterloo IPA", "Weihenstephan Kristalweiss", "Wellington Arkell Best Bitr", "Wellington County Dark Ale", "Wellington Special Pale", "Wells IPA"
			],
		};

		typeof $.typeahead === 'function' && $.typeahead({
			input: ".js-typeahead",
			minLength: 1,
			maxItem: 15,
			order: "asc",
			hint: true,
			/*group: {
				template: "[[group]] beers!"
			},*/
			maxItemPerGroup: 5,
			backdrop: {
				"background-color": "#fff"
			},
			/*href: "/beers/[[group]]/[[display]]/",*/
			/*dropdownFilter: "all beers",*/
			emptyTemplate: 'Sonuç yok ',
			source: {
				post_title: {
					data: data
				},
			},
			callback: {
				onClickAfter: function (node, a, item, event) {

					// href key gets added inside item from options.href configuration
					alert(item);

				}
			},
			debug: true
		});

	</script>--}}

	<script type="text/javascript">

	function fileuploadSuccessFn(file,done) {

		$('.sliderTemp').html('<img src="{{ asset('images/icon_size/') }}/'+done.filename+'" width="150px"/ data-id="'+done.id+'">');

		$('.sliderSetting').html('<input type="text" class="form-control" name="order_no" placeholder="Sıra numarası ?"><input type="text" class="form-control" name="link" placeholder="Bağlantı Ara">');

		$('.process').html('<div class="btn btn-danger fileDelete" data-id="'+done.id+'"><i class="fa fa-remove"></i> Sil</div><div class="btn btn-success fileSave"><i class="fa fa-check"></i> Kaydet</div>');

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
			var dataId = $(this).attr('data-id');
			$(this).parents('tr').remove();
		ajaxPost('{{ route('admin.uploadDelete') }}',fnSelect,'id='+dataId);

		ajaxPost('{{ route('admin.sliderDelete') }}',fnSelect,'id='+dataId);

	});

	$(document).on('click','.fileSave', function() {
		var dataId = $('.sliderTemp').children('img').attr('data-id');
		var order_no = $('input[name=order_no]').val();
		var link = $('input[name=link]').val();

		ajaxPost('{{ route('admin.sliderSave') }}',fnSelect,'image_id='+dataId+'&order_no='+order_no+'&link='+link);
	});

	$(document).on('click','.fileUpdate', function() {
		var dataId = $(this).attr('data-id');

		var thistd = $(this).parents('tr').children('td')[1];
		var order_no = $(thistd).find('input[name=order_no]').val();
		var link = $(thistd).find('input[name=link]').val();

		ajaxPost('{{ route('admin.sliderEdit') }}',fnSelect,'image_id='+dataId+'&order_no='+order_no+'&link='+link);
	});

	function fnSelect(data) {

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
