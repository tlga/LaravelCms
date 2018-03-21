@extends('front.layouts.master')
@section('header_script')
  <link rel="stylesheet" href="{{ asset('cssfr/blueimp-gallery.min.css') }}">

@stop
@section('content')






            <div class="content container main">

                <div class="featured">
                  <div class="featuredImg">
                    <div class="breadcrumb_text">
                     <a href="{{ route('single') }}" title="Ana Sayfa">Ana Sayfa</a>
                     <a href="{{ route('ecommerce')."/".$categorySlug }}" title="{{ $categoryName }}">{{ $categoryName }}</a>
                    </div>
                    <img src="{{ asset('/imgfr/ecommerce-featured.jpg') }}" class="img-fluid">
                  </div>
                </div>
              @include('front.layouts.slogan')


              <div class="main-content">
                <div class="post_title text-center p-20">
                  <h1>{{ $title }}</h1>
                </div>
                <div class="row">
                  <div class="col-md-3 sidebar">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Ne Aramıştınız ?">
                      <span class="input-group-btn">
                        <button class="btn btn-default btn-orange" type="button">Ara</button>
                      </span>
                    </div><!-- /input-group -->

                    <div class="sidebar_title">
                      <h5>Kampanyalar</h5>
                    </div>
                    {{ \App\Logic\Functions\Functions::getPost('kampanyalar','3','image-featured') }}

                    <div class="sidebar_title">
                      <h5>İndirimler</h5>
                    </div>

                    {{ \App\Logic\Functions\Functions::getProduct('indirimler','3','image-left') }}

                  </div>
                  <div class="col-md-9">
                    <div class="row">

                      @foreach($categorySingleProduct as $c)
                        <div class="col-md-4">
                          <div class="widget widget-img-box">
                            <div class="widget_img">
                              <img src="{{ asset("/images/full_size/" . \App\Logic\Functions\Functions::getImage($c->product_featured)) }}" class="img-fluid"/>
                            </div>
                            <div class="widget_info">
                              <label class="widget_head"><h4>{{ $c->product_title }}</h4></label>
                            </div>
                            <div class="price">
                              {{ $c->product_price }}
                            </div>
                            <div class="old_price">
                              {{ $c->product_old_price }}
                            </div>
                            <div class="percent">
                              %{{ $c->product_price_percent }}
                            </div>
                            <div class="widget_btn">
                              <a class="btn btn-custom btn-block" href="{{ route('ecommerce')."/".$c->slug."/".$c->product_slug }}"><i class="fas fa-search-plus"></i> İNCELE</a>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>



                  </div>
                </div>
              </div>
            </div>


          @if(isset($userForm)) {!! $userForm !!} @endif


@stop

@section('footer_script')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('jsfr/blueimp-gallery.min.js') }}"></script>
    <script src="{{ asset('jsfr/post.js') }}" type="text/javascript"></script>
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

      $(document).on('click', '.submitButton', function(e) {
        var formData = new FormData($(this).parents("form")[0]);

        ajaxPost($(this).parents('form').attr('action'),func,formData);

        /*formClear($(this));*/
      });

      function func(data) {
        if(data.msg) {
          errorMsg(data.msg);
        } else {
          window.location.href = data.redirect;
        }
      }

      $(document).ready(function() {
        $('#fileupload').append('<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">');

        /* Accordion */
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        }
        /* Accordion */

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