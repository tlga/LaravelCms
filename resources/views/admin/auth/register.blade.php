@extends('authLayout.master')
@section('content')
    <div class="m-login__head">
        <h3 class="m-login__title">
            Yeni Yönetici Oluştur
        </h3>
        <p>Not: Bu sayfaya sadece yönetici yetkisiyle ulaşılabilir! Kullanıcılar bu forma ulaşamaz.</p>
    </div>
    <form class="m-login__form m-form" method="POST" action="{{ url('admin/register') }}">
        {{ csrf_field() }}
        <div class="form-group m-form__group {{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus placeholder="Ad soyad">

            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group m-form__group {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-posta adresi">

            @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group m-form__group {{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" placeholder="Şifre">

            @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group m-form__group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Şifre tekrarı">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <div class="m-login__form-action">
            <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                Kaydet
            </button>
        </div>

        <div class="form-group m-form__group ">
            <a href="{{ route('admin.home') }}" title="Admin Paneli"><i class="fa fa-chevron-left"></i> Panele Dön</a>
        </div>
    </form>
    </div>
@endsection
