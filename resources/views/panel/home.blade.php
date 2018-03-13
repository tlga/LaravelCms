@extends('layouts.master')

@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<!--Begin::Main Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__body  m-portlet__body--no-padding">
					<div class="row m-row--no-padding m-row--col-separator-xl">
						<div class="col-md-12 col-lg-6 col-xl-3">
							<!--begin::Total Profit-->
							<div class="m-widget24">
								<div class="m-widget24__item">
									<h4 class="m-widget24__title">
										Toplam Giriş
									</h4>
									<br>
												<span class="m-widget24__desc">
													Alt sayfalar dahil
												</span>
												<span class="m-widget24__stats m--font-brand">
													2.892.485
												</span>
									<div class="m--space-10"></div>
									<div class="progress m-progress--sm">
										<div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
												<span class="m-widget24__change">
													Tahmini Giriş Yüzdesi
												</span>
												<span class="m-widget24__number">
													78%
												</span>
								</div>
							</div>
							<!--end::Total Profit-->
						</div>
						<div class="col-md-12 col-lg-6 col-xl-3">
							<!--begin::New Feedbacks-->
							<div class="m-widget24">
								<div class="m-widget24__item">
									<h4 class="m-widget24__title">
										Aylık Giriş
									</h4>
									<br>
												<span class="m-widget24__desc">
													Alt Sayfalar Dahil
												</span>
												<span class="m-widget24__stats m--font-info">
													1349
												</span>
									<div class="m--space-10"></div>
									<div class="progress m-progress--sm">
										<div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
												<span class="m-widget24__change">
													Tahmini Giriş Yüzdesi
												</span>
												<span class="m-widget24__number">
													84%
												</span>
								</div>
							</div>
							<!--end::New Feedbacks-->
						</div>
						<div class="col-md-12 col-lg-6 col-xl-3">
							<!--begin::New Orders-->
							<div class="m-widget24">
								<div class="m-widget24__item">
									<h4 class="m-widget24__title">
										Günlük Giriş
									</h4>
									<br>
												<span class="m-widget24__desc">
													Alt Sayfalar Dahil
												</span>
												<span class="m-widget24__stats m--font-danger">
													567
												</span>
									<div class="m--space-10"></div>
									<div class="progress m-progress--sm">
										<div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
												<span class="m-widget24__change">
													Tahmini Giriş Yüzdesi
												</span>
												<span class="m-widget24__number">
													69%
												</span>
								</div>
							</div>
							<!--end::New Orders-->
						</div>
						<div class="col-md-12 col-lg-6 col-xl-3">
							<!--begin::New Users-->
							<div class="m-widget24">
								<div class="m-widget24__item">
									<h4 class="m-widget24__title">
										Toplam Yazı
									</h4>
									<br>
												<span class="m-widget24__desc">
													Tüm Yazılar
												</span>
												<span class="m-widget24__stats m--font-success">
													276
												</span>
									<div class="m--space-10"></div>
								</div>
							</div>
							<!--end::New Users-->
						</div>
					</div>
				</div>
		</div>
		<!--End::Main Portlet-->

		<!--Begin::Main Portlet-->
		<div class="row">
			<div class="col-xl-8">
				<div class="m-portlet m-portlet--full-height">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Son Yazılar
								</h3>
							</div>
						</div>
						<div class="m-portlet__head-tools">
							<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget5_tab1_content" role="tab">
										Son girilen tüm yazılar listelenmektedir
									</a>
								</li>
								{{--<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content" role="tab">
										Çok Okunan
									</a>
								</li>--}}
							</ul>
						</div>
					</div>
					<div class="m-portlet__body">
						<!--begin::Content-->
						<div class="tab-content">
							<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
								<!--begin::m-widget5-->
								<div class="m-widget5">

										<a href="#" style="text-decoration:none;" target="_blank">
											<div class="m-widget5__item">
												<div class="m-widget5__pic">
													<img class="m-widget7__img" src="" alt="">
												</div>
												<div class="m-widget5__content">
													<h4 class="m-widget5__title">

													</h4>
												{{--<span class="m-widget5__desc">
													Make Metronic Great  Again.Lorem Ipsum Amet
												</span>--}}
													<div class="m-widget5__info">
													<span class="m-widget5__author">

													</span>
													<span class="m-widget5__info-author-name" style="text-transform:capitalize;">

													</span>
													<span class="m-widget5__info-label">

													</span>
													<span class="m-widget5__info-date m--font-info">

													</span>
													</div>
												</div>
												<div class="m-widget5__stats1">
												<span class="m-widget5__number">

												</span>
													<br>
												<span class="m-widget5__sales">

												</span>
												</div>
												<div class="m-widget5__stats2">
												<span class="m-widget5__number">

												</span>
													<br>
												<span class="m-widget5__votes">

												</span>
												</div>
											</div>
										</a>


								</div>
								<!--end::m-widget5-->
							</div>
							<div class="tab-pane" id="m_widget5_tab2_content" aria-expanded="false">
								<!--begin::m-widget5-->
								<div class="m-widget5">
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product11.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Branding Mockup
											</h4>
										<span class="m-widget5__desc">
											Make Metronic Great  Again.Lorem Ipsum Amet
										</span>
											<div class="m-widget5__info">
											<span class="m-widget5__author">
												Author:
											</span>
											<span class="m-widget5__info-author m--font-info">
												Fly themes
											</span>
											<span class="m-widget5__info-label">
												Released:
											</span>
											<span class="m-widget5__info-date m--font-info">
												23.08.17
											</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
										<span class="m-widget5__number">
											24,583
										</span>
											<br>
										<span class="m-widget5__sales">
											sales
										</span>
										</div>
										<div class="m-widget5__stats2">
										<span class="m-widget5__number">
											3809
										</span>
											<br>
										<span class="m-widget5__votes">
											votes
										</span>
										</div>
									</div>
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product6.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Great Logo Designn
											</h4>
										<span class="m-widget5__desc">
											Make Metronic Great  Again.Lorem Ipsum Amet
										</span>
											<div class="m-widget5__info">
											<span class="m-widget5__author">
												Author:
											</span>
											<span class="m-widget5__info-author m--font-info">
												Fly themes
											</span>
											<span class="m-widget5__info-label">
												Released:
											</span>
											<span class="m-widget5__info-date m--font-info">
												23.08.17
											</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
										<span class="m-widget5__number">
											19,200
										</span>
											<br>
										<span class="m-widget5__sales">
											sales
										</span>
										</div>
										<div class="m-widget5__stats2">
										<span class="m-widget5__number">
											1046
										</span>
											<br>
										<span class="m-widget5__votes">
											votes
										</span>
										</div>
									</div>
									<div class="m-widget5__item">
										<div class="m-widget5__pic">
											<img class="m-widget7__img" src="assets/app/media/img//products/product10.jpg" alt="">
										</div>
										<div class="m-widget5__content">
											<h4 class="m-widget5__title">
												Awesome Mobile App
											</h4>
										<span class="m-widget5__desc">
											Make Metronic Great  Again.Lorem Ipsum Amet
										</span>
											<div class="m-widget5__info">
											<span class="m-widget5__author">
												Author:
											</span>
											<span class="m-widget5__info-author m--font-info">
												Fly themes
											</span>
											<span class="m-widget5__info-label">
												Released:
											</span>
											<span class="m-widget5__info-date m--font-info">
												23.08.17
											</span>
											</div>
										</div>
										<div class="m-widget5__stats1">
										<span class="m-widget5__number">
											10,054
										</span>
											<br>
										<span class="m-widget5__sales">
											sales
										</span>
										</div>
										<div class="m-widget5__stats2">
										<span class="m-widget5__number">
											1103
										</span>
											<br>
										<span class="m-widget5__votes">
											votes
										</span>
										</div>
									</div>
								</div>
								<!--end::m-widget5-->
							</div>
						</div>
						<!--end::Content-->
					</div>
				</div>
				<!--end:: Widgets/Best Sellers-->
			</div>
			<div class="col-xl-4">
				<!--begin:: Widgets/Audit Log-->
				<div class="m-portlet m-portlet--full-height">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Bildirimler
								</h3>
							</div>
						</div>
						{{--<div class="m-portlet__head-tools">
							<ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget4_tab1_content" role="tab">
										Günlük
									</a>
								</li>
							</ul>
						</div>--}}
					</div>
					<div class="m-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="m_widget4_tab1_content">
								<div class="m-scrollable" data-scrollable="true" data-max-height="400" style="height: 400px; overflow: hidden;">
									<div class="m-list-timeline m-list-timeline--skin-light">
										<div class="m-list-timeline__items">

											{{--<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
											<span href="" class="m-list-timeline__text">
												New order received
												<span class="m-badge m-badge--danger m-badge--wide">
													urgent
												</span>
											</span>
											<span class="m-list-timeline__time">
												7 hrs
											</span>
											</div>--}}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end:: Widgets/Audit Log-->
			</div>
		</div>
		<!--End::Main Portlet-->

		<!--Begin::Main Portlet-->
		<div class="m-portlet">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-xl-4">
						<!--begin:: Widgets/Stats2-1 -->
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											App Name
										</h3>
									</div>
									<div class="col m--align-right">
									<span class="m-widget1__number m--font-brand">
										{{ env('APP_NAME') }}
									</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Veritabanı
										</h3>
									</div>
									<div class="col m--align-right">
									<span class="m-widget1__number m--font-brand">
										{{ env('DB_DATABASE') }}
									</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Gönderici Mail
										</h3>
									</div>
									<div class="col m--align-right">
									<span class="m-widget1__number m--font-brand">
										{{ env('MAIL_USERNAME') }}
									</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Local Ip
										</h3>
									<span class="m-widget1__desc">
										Sizin Ip Adresiniz
									</span>
									</div>
									<div class="col m--align-right">
									<span class="m-widget1__number m--font-danger">
										{{ $_SERVER['REMOTE_ADDR'] }}
									</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Sunucu Ip
										</h3>
									<span class="m-widget1__desc">
										Sunucu Ip Adresi
									</span>
									</div>
									<div class="col m--align-right">
									<span class="m-widget1__number m--font-success">
										{{ gethostbyname(env('APP_URL')) }}
									</span>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Stats2-1 -->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Daily Sales-->
						<div class="m-widget14">
							<div class="m-widget14__header m--margin-bottom-30">
								<h3 class="m-widget14__title">
									Aylık Giriş
								</h3>
							<span class="m-widget14__desc">
								Aylık siteye giriş oranları
							</span>
							</div>
							<div class="m-widget14__chart" style="height:120px;">
								<canvas  id="m_chart_daily_sales"></canvas>
							</div>
						</div>
						<!--end:: Widgets/Daily Sales-->
					</div>
					<div class="col-xl-4">
						<!--begin:: Widgets/Profit Share-->
						<div class="m-widget14">
							<div class="m-widget14__header">
								<h3 class="m-widget14__title">
									Genel Bilgiler
								</h3>

							</div>
							<div class="row  align-items-center">
								<div class="m-list-timeline m-list-timeline--skin-light">
									<div class="m-list-timeline__items">
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge m-list-timeline__badge--success"></span>
											<span class="m-list-timeline__text">
												digitalocean.com
											</span>
											<span class="m-list-timeline__time">
												Name Server
											</span>
										</div>
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge m-list-timeline__badge--info"></span>
											<span class="m-list-timeline__text">
												Ubuntu 16.04.4 x64
											</span>
											<span class="m-list-timeline__time">
												Sunucu Os
											</span>
										</div>
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge m-list-timeline__badge--danger"></span>
											<span class="m-list-timeline__text">
												/var/www/your_site/public
											</span>
											<span class="m-list-timeline__time">
												Kök Dizin
											</span>
										</div>
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge m-list-timeline__badge--accent"></span>
											<span class="m-list-timeline__text">
												Aura Administrative Transaction System 0.0.9
											</span>
											<span class="m-list-timeline__time">
												Versiyon
											</span>
										</div>
									</div>
								</div>

							</div>
						</div>
						<!--end:: Widgets/Profit Share-->
					</div>
				</div>
			</div>
		</div>
		<!--End::Main Portlet-->

	</div>
</div>
@stop
