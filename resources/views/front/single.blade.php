@extends('front.layouts.master')
@section('header_script')
  <link rel="stylesheet" href="{{ asset('fr/css/blueimp-gallery.min.css') }}">

@stop
@section('content')

  <div class="main-raised">


          @if(isset($featured) && ($featured != null))
          <div class="featuredImg">
            <img src="{{ asset('/images/full_size/'.$featured) }}" class="img-fluid">
          </div>
          @endif
          {!! str_replace('\\','',$content) !!}

          @if(isset($userForm)) {!! $userForm !!} @endif


      @include('front.layouts.singlePageStatic')


@stop

@section('footer_script')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="{{ asset('fr/js/blueimp-gallery.min.js') }}"></script>
    <script src="{{ asset('fr/js/post.js') }}" type="text/javascript"></script>
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