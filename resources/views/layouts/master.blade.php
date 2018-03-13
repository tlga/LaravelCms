<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>
    {{ config('app.name') }}
  </title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--begin::Web font -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <!--end::Web font -->
  <!--begin::Base Styles -->
  <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/fnSetting.css') }}" rel="stylesheet" type="text/css" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.css" rel="stylesheet" type="text/css" />

  <!--end::Base Styles -->
  <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
  @yield('Header_Script')
</head>
<input type="hidden" value="{{ $url = Request::root() }}"/>

<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <!-- BEGIN: Header -->
  @include('layouts.navbar')


    <!-- begin::Body -->
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <!-- BEGIN: Left Aside -->
    @include('layouts.sidebar')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
      <!-- BEGIN: Subheader -->
      <div class="m-subheader ">
        <div class="d-flex align-items-center">
          <div class="mr-auto">
            <h3 class="m-subheader__title ">
              @if(isset($title)) {{ $title }} @else Başlık belirtilmedi! @endif
            </h3>
          </div>
          <div>

          </div>
        </div>
      </div>
      <!-- END: Subheader -->
    @yield('content')
    </div>

      </div>
  @include('layouts.footer')
  </div>
@include('layouts.qSidebar')
<!--begin::Base Scripts -->
<script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Snippets -->
<script src="{{ asset('js/dashboard.js') }}" type="text/javascript"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
  var url = '{{ Request::root() }}'
</script>

<!--end::Page Snippets -->
<!--begin::Page Scripts -->
@yield('Footer_Script')
<!--end::Page Scripts -->

<!-- Confirm Message -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Uyarı
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												&times;
											</span>
        </button>
      </div>
      <div class="modal-body">
        Bu işlemi uygulamak istiyormusun!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">
          Vazgeç
        </button>
        <button type="button" class="btn btn-primary confirm">
          Uygula
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Confirm Message -->

<!-- Warning Message -->
<div class="m-alert m-alert--icon alert alert-primary myAlertStyle fade" role="alert">
  <div class="m-alert__icon">
    <i class="fa fa-user-secret"></i>
  </div>
  <div class="m-alert__text">
    <div class="dataMsg"></div>
  </div>
  <div class="m-alert__actions" style="width: 76px;">
    <button type="button" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide">
      <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Yükleniyor...</span>
    </button>
  </div>
</div>

</body>
<!-- end::Body -->
</html>
