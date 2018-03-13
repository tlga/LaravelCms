<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>
    Aura Agency Web Admin Panel Systems
  </title>
  <meta name="description" content="Aura Digital Agency | Design,Software,Photography,Production">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  <!--end::Base Styles -->
  <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin" id="m_login">
    <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
      <div class="m-stack m-stack--hor m-stack--desktop">
        <div class="m-stack__item m-stack__item--fluid">
          <div class="m-login__wrapper">
            <div class="m-login__logo">
              <a href="#">
                <img src="{{ asset('img/logo.png') }}">
              </a>
            </div>
            <div class="m-login__signin">


              @yield('content')

              <div class="m-login__signup">
                <div class="m-login__head">
                  <h3 class="m-login__title">
                    Aura Administrative Transaction System
                  </h3>
                  <div class="m-login__desc">
                    Destek & İletişim talebinde bulun
                  </div>
                </div>
                <form class="m-login__form m-form" action="">
                  <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Ad Soyad" name="fullname">
                  </div>
                  <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                  </div>
                  <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Konu" name="subject" autocomplete="off">
                  </div>
                  <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Açıklama" name="content" autocomplete="off">
                  </div>

                  <div class="m-login__form-action">
                    <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                      Gönder
                    </button>
                    <button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
                      Vazgeç
                    </button>
                  </div>
                </form>
              </div>

              <div class="m-login__forget-password">
                <div class="m-login__head">
                  <h3 class="m-login__title">
                    Şifrenimi Unuttun ?
                  </h3>
                  <div class="m-login__desc">
                    Şifreni sıfırlayabilmemiz için email adresini yazıp gönder:
                  </div>
                </div>

                @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                @endif
                <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}

                  <div class="form-group m-form__group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="email" value="{{ old('email') }}" autocomplete="off" required>
                    @if ($errors->has('email'))
                      <span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
												</span>
                    @endif
                  </div>

                  <div class="m-login__form-action">
                    <button type="submit" id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                      Gönder
                    </button>
                    <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                      Vazgeç
                    </button>
                  </div>
                </form>
              </div>

            </div>
          </div>
          <div class="m-stack__item m-stack__item--center">
            <div class="m-login__account">
								<span class="m-login__account-msg">
									&copy; {{ date('Y',time()) }} <a href="https://auramedya.com" title="Aura Medya"><img src="{{ asset('img/logo-2.png') }}" alt="Aura Medya"> Aura Dijital Creative Solutions</a>
								</span>
              <br />
              Administrative Transaction System
              <a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
                Destek Talebi
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ asset('img/bg/bg-4.jpg') }})">
        <div class="m-grid__item m-grid__item--middle">
          <h3 class="m-login__welcome">
            Aura Digital Agency
          </h3>
          <p class="m-login__msg">
            Tasarım | Yazılım | Prodüksiyon | Fotoğrafçılık
            <br/><br/>
            "Aura'nın Eşsiz Dünyasına Tanık Olun..."
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end:: Page -->
  <!--begin::Base Scripts -->
  <script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
  <!--end::Base Scripts -->
  <!--begin::Page Snippets -->
  <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
  <!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>
