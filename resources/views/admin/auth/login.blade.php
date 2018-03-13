@extends('authLayout.master')
@section('content')
		<div class="m-login__head">
			<h3 class="m-login__title">
				Yönetim Paneline Giriş
			</h3>
		</div>
		<form class="m-login__form m-form" method="POST" action="{{ url('/admin/login') }}">
			{{ csrf_field() }}
			<div class="form-group m-form__group {{ $errors->has('email') ? ' has-error' : '' }}">
				<input class="form-control m-input" type="text" placeholder="E-posta adresiniz" name="email" id="email" autocomplete="off" value="{{ old('email') }}" required autofocus>
				@if ($errors->has('email'))
					<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
							</span>
				@endif
			</div>
			<div class="form-group m-form__group {{ $errors->has('password') ? ' has-error' : '' }}">
				<input class="form-control m-input m-login__form-input--last" type="password" id="password" name="password" placeholder="Şifreniz" required>
				@if ($errors->has('password'))
					<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
							</span>
				@endif
			</div>
			<div class="row m-login__form-sub">
				<div class="col m--align-left">
					<label class="m-checkbox m-checkbox--focus">
						<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
						Hatırla beni
						<span></span>
					</label>
				</div>
				<div class="col m--align-right">
					<a href="{{ url('/admin/password/reset') }}" id="m_login_forget_password" class="m-link">
						Şifrenimi unuttun ?
					</a>
				</div>
			</div>
			<div class="m-login__form-action">
				<button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
					Giriş Yap
				</button>
			</div>
		</form>
	</div>
@stop