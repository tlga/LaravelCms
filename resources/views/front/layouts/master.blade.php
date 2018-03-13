<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="tr-TR" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>@if(isset($title)) {{ $title }} @else  @endif</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <link rel="canonical" href="{{ Request::url() }}" />
  <meta name="generator" content="{{ Request::url() }}"/>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>
  <link href="" hreflang="tr" rel="alternate"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="name" content=""/>
  <meta name="rating" content="all"/>
  <meta name="language" content="Turkish"/>
  <meta property="og:locale" content="tr_TR" />
  <meta name="owner" content=""/>
  <meta name="distribution" content="global"/>
  <meta name="resource-type" content="document"/>
  <meta name="doc-type" content="white paper"/>
  <meta name="doc-class" content="living document"/>
  <meta name="doc-rights" content="public"/>
  <meta name="classification" content="WebSite"/>
  <meta name="audience" content="all"/>
  <meta name="copyright" content="{{ date('Y',time()) }} .com"/>
  <meta property="article:author" content="https://www.facebook.com/" />
  <meta name="date" content="{{ date('Y-m-d',time()) }}" scheme="YYYY-MM-DD"/>
  <meta name="image" content="{{ asset('img/shareImg.jpg') }}"/>
  <meta name="thumbnail" content="{{ asset('img/shareImg.jpg') }}"/>
 {{-- <meta itemprop="datePublished" content=""/>
  <meta itemprop="dateModified" content=""/>
  <meta property="fb:app_id" content="">--}}
  <meta property="og:title" content=""/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="{{ asset('img/shareImg.jpg') }}"/>
  <meta property="og:image:width" content="913" />
  <meta property="og:image:height" content="615" />
  <link rel="image_src" type="image/jpeg" href="{{ asset('img/shareImg.jpg') }}"/>
 {{-- <meta name="twitter:site" content=""/>
  <meta name="twitter:url" content=""/>
  <meta name="twitter:title" content=""/>
  <link rel="publisher" href="https://plus.google.com/+"/>
  <meta name="twitter:creator" content=""/>
  <meta property="og:type" content="article"/>
  <meta property="article:section" content="Haber"/>
  <meta property="article:publisher" content="https://www.facebook.com/"/>
  <meta property="article:tag" content=""/>
  <meta name="twitter:card" content="summary"/>
  <meta name="twitter:image" content=""/>
  <meta property="og:description" content=""/>
  <meta name="twitter:description" content=""/>
  <meta name="news_keywords" content=""/>--}}

  <meta property="og:site_name" content=""/>
  <meta http-equiv="Content-Language" content="tr"/>
  <meta name="revisit-after" content="1"/>
  <meta name="googlebot" content="index, follow"/>
  <meta name="robots" content="index, follow"/>
  <meta http-equiv="cleartype" content="on"/>
  <meta name="MobileOptimized" content="320"/>
  <meta name="HandheldFriendly" content="True"/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  {{--<link rel="search" type="application/opensearchdescription+xml" href="https://www.sosyallog.com/opensearch.xml" title="Sosyallog"/>--}}
  <meta name="application-name" content=""/>
  <meta name="apple-mobile-web-app-title" content=""/>
  <link rel="manifest" href="{{ asset('fr/img/favicon/site.webmanifest') }}">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}"/>
  <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}"/>
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('img/favicon/favicon-32x32.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('img/favicon/android-chrome-192x192.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('img/favicon/android-chrome-192x192.png') }}" sizes="196x196" />
  <link rel="icon" type="image/png" href="{{ asset('img/favicon/mstile-150x150.png') }}" sizes="96x96" />
  <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-32x32.png') }}" sizes="32x32" />
  <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-16x16.png') }}" sizes="16x16" />
  <link rel="icon" type="image/png" href="{{ asset('img/favicon/mstile-150x150.png') }}" sizes="128x128" />
  <meta name="application-name" content="My Kask"/>
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <meta name="msapplication-square70x70logo" content="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <meta name="msapplication-square150x150logo" content="{{ asset('img/favicon/mstile-150x150.png') }}" />
  <meta name="msapplication-wide310x150logo" content="{{ asset('img/favicon/android-chrome-384x384.png') }}" />
  <meta name="msapplication-square310x310logo" content="{{ asset('img/favicon/android-chrome-384x384.png') }}" />
  {{--<link rel="amphtml" href="#"/>--}}
  <meta http-equiv="Content-Language" content="tr"/>
  {{--<meta name="google-site-verification" content="cBLSzcEsuQJm5ENUKkKr8tIdbf9iM_INbx5zpxG-1ao" />
  <meta name="yandex-verification" content="9c79ac60e4aa789b" />
  <meta name="msvalidate.01" content="B419BC4837CA12652EA7952ED5C57F01" />--}}
  <meta property="fb:pages" content="271933522968780" />
  {{--<meta name="p:domain_verify" content="3c70a5a1542a4428bc3db2f0c596b995" />--}}
  <script defer src="{{ asset('jsfr/all.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('cssfr/bootstrap.min.css') }}">
  @yield('header_script')
</head>

<body>
@include('front.layouts.header')
@yield('content')
@include('front.layouts.footer')

<script type="text/javascript" src="{{ asset('jsfr/jquery-3.2.1.min.js') }}"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('jsfr/bootstrap.min.js') }}"></script>
<script src="{{ asset('jsfr/bootbox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('jsfr/jquery.fileupload.js') }}" type="text/javascript"></script>
<script src="{{ asset('jsfr/jquery.knob.js') }}" type="text/javascript"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('jsfr/popper.min.js') }}"></script>

{{--<div class="blackBackMessage">
  <div class="errorContent alignCenterSub textAlignCenter"><div class="errorMsg"></div><div class="errorClose btn btn-primary">Kapat</div></div>
</div>--}}
@if (session('errorMsg'))
  <div class="alert alert-info customInfo">
    <i class="fas fa-info-circle"></i> {{ session('errorMsg') }}
  </div>
  <script>
    setTimeout (function() {
      $('.customInfo').fadeOut();
    }, 7000);
  </script>
@endif
@yield('footer_script')
</body>
</html>