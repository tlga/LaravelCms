@extends('front.layouts.master')
@section('header_script')
    <style>
        .home-top .bottomStripe {
            bottom:75px;
        }

    </style>
@stop
@section('content')

    <div class="main-raised">

        <div class="home-top">
                <div class="baseStripe">
                    <span class="stripe1"></span>
                    <span class="stripe2"></span>
                    <span class="stripe3"></span>
                </div>
                <div class="bottomStripe">
                    <span class="stripe1"></span>
                    <span class="stripe2"></span>
                </div>
            <div class="section pt-0">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}">
                    {{ csrf_field() }}
                    <div class="row zTopRow">
                        <div class="col-md-6 offset-md-3 text-center card">
                            <h1 class="text-center p20">Giriş Yap</h1>

                            <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" id="email" class="form-control validate" value="{{ old('email') }}" name="email">
                                <label for="email" data-error="Geçersiz" data-success="Geçerli">E-posta Adresiniz</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="password" class="form-control validate" name="password">
                                <label for="password" data-error="Geçersiz" data-success="Geçerli">Şifre</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" style="
                                                display: inline-block!important;
                                                visibility: visible;
                                                left:0;
                                                position: relative;"> Beni Hatırla
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-4">
                                        <a class="black-text" href="{{ url('/user/password/reset') }}">
                                            Şifrenizimi unuttunuz ?
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4">
                                    <div class="md-form text-center">
                                        <button type="submit" class="btn btn-primary ">Giriş Yap</button>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center">Ya da</div>
                            <div class="text-center p20">
                                <h3>
                                    <a href="{{ route('register') }}">Üye Olmak İçin Tıklayın</a>
                                </h3>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>


        @include('front.layouts.singlePageStatic')


        @stop

        @section('footer_script')
            <script>



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

            </script>


@stop