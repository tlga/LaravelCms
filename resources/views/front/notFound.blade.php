@extends('front.layouts.master')
@section('header_script')
  <link rel="stylesheet" href="{{ asset('fr/css/blueimp-gallery.min.css') }}">
@stop
@section('content')

<div class="main-raised">
  <div class="home-top">
    <div class="StripeBackground accelerated stripes-header">
      <div class="stripe s0"></div>
      <div class="stripe s1"></div>
      <div class="stripe s2"></div>
      <div class="stripe s3"></div>
      <div class="stripe s4"></div>
      <div class="stripe s5"></div>
      <div class="stripe s6"></div>
    </div>
    <div class="section pt-0">
  <div class="row opRow">

    <div class="col-md-12">
      <div class="subHeadTitle">
        <h1 class="capitalize p-10 text-center">Geçersiz Rota! Bu Url Adresi Bulunamadı.</h1>
      <div class="dividerBlack"></div>
      </div>
      <div class="singleContent">
        <div class="portlet">
          <div class="row text-center">
            <div class="col-md-8">
              <span style="font-size:50px; color:#d14231;">Ooops!</span><h3>Üzgünüz, aradığınız sayfaya ulaşamadık.</h3>
              <p>Bu url adresi geçersiz! Yetkiniz olmayan bir sayfayı önizlemek istiyor olabilirsiniz veya bu sayfa silinmiş olabilir. Eğer bu sayfaya bir problem sonucunda ulaşamadığınızı düşünüyorsanız, lütfen <a href="mailto:info@mykask.com">info@mykask.com</a> adresine mail atarak bu hatayı bize bildiriniz!</p>
            </div>
            <div class="col-md-4">
              <img src="{{ asset('/fr/img/not-found.png') }}" alt="404 Sayfa Bulunamadı!"/>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

    </div>
  </div>


@stop

@section('footer_script')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('fr/js/blueimp-gallery.min.js') }}"></script>
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
    </div>
    <script>

      $(document).ready(function() {
        $('#fileupload').append('<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">');
      });

      document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target,
          options = {index: link, event: event},
          links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
      };
      blueimp.Gallery(
        document.getElementById('links').getElementsByTagName('a'),
        {
          container: '#blueimp-gallery-carousel',
          carousel: true
        }
      );
    </script>


@stop