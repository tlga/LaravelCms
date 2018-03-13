
@extends('front.layouts.master')
@section('header_script')
    <style>
        .home-top .bottomStripe {
            bottom:150px;
        }
        .home-top .baseStripe {
            height:75%;
        }
    </style>
@stop
@section('content')

    <div class="main-raised">

        <div class="home-top">
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
                <div class="row zTopRow">
                    <div class="col-md-6 offset-md-3 text-center card">
                        <h1 class="text-center p20">Üye Ol</h1>




                    <form class="form-horizontal" id="registerForm" name="signup" role="form" method="POST" action="{{ url('/user/register') }}" enctype="multipart/form-data" novalidate>
                        {{ csrf_field() }}

                        <p>Yoğun ilginiz için teşekkür ederiz. Form'daki tüm alanlar zorunludur. Telefonunuza gelecek kod için numaranızı doğru girmeye dikkat ediniz.</p>

                        @if ($errors->has('vergilevhasi'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('vergilevhasi') }}</strong>
                                    </span>
                        @endif
                        @if ($errors->has('firmatemsilcisitc'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('firmatemsilcisitc') }}</strong>
                                    </span>
                        @endif
                        <div class="row p20">
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input " type="radio" name="select" id="select1" value="1" checked>
                                    <label class="form-check-label" for="select1">
                                        Hususi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="select" id="select2" value="2">
                                    <label class="form-check-label" for="select2">
                                        Ticari
                                    </label>
                                </div>
                            </div>
                        </div>
                            {{--@if(!empty($errors->messages())) {{ dd($errors) }} @endif--}}
                                <div class="ticari"></div>
                                <div class="md-form{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="name" name="name" class="form-control validate" value="{{ old('name') }}" autofocus>
                                    <label for="name" data-error="Geçersiz" data-success="Geçerli">Ad Soyad</label>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
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

                                <div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="password1" class="form-control validate" name="password_confirmation">
                                    <label for="password1" data-error="Geçersiz" data-success="Geçerli">Şifre Tekrarı</label>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="email" class="form-control validate" value="{{ old('email') }}" name="email">
                                    <label for="email" data-error="Geçersiz" data-success="Geçerli">E-posta Adresiniz (örnek@mykask.com)</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="md-form{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <i class="fa fa-phone prefix"></i>
                                    <input type="text" id="phone" class="form-control validate" name="phone">
                                    <label for="phone" data-error="Geçersiz" data-success="Geçerli">Telefon Örn.: 05xxxxxxxxx</label>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form{{ $errors->has('population') ? ' has-error' : '' }}">
                                    <i class="fas fa-id-card prefix"></i>
                                    <input type="text" id="population" class="form-control validate" name="population">
                                    <label for="population" data-error="Geçersiz" data-success="Geçerli">T.C. Kimlik No.</label>
                                    @if ($errors->has('population'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('population') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group md-form{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <select class="form-control" id="exampleSelect1" name="city">
                                        <option value="">İkametgah İli</option>
                                        @foreach($city as $c)
                                            <option value="{{ $c->id }}">{{ $c->city_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="clearfix"></div>
                                <div class="md-form" style="margin-left: 46px;">
                                    <div class="row">
                                        <!--First column-->
                                        <div class="col-md-12">

                                            <div class="md-form{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <textarea type="text" id="form76" class="md-textarea" name="address"></textarea>
                                                <label for="form76">Adres</label>
                                                @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        <div class="evraklar"></div>

                            <div class="custom-control custom-checkbox mb-3 {{ $errors->has('confirm') ? ' has-error' : '' }}">
                                <input type="checkbox" name="confirm" class="custom-control-input" id="confirm" required>
                                <label class="custom-control-label" for="confirm"><a href="#" target="_blank">Hizmet Şartlarını</a> ve <a href="#" target="_blank">Kullanıcı Sözleşmesini</a> kabul ediyorum.</label>

                                <div class="invalid-feedback">
                                    @if ($errors->has('confirm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="md-form text-center">
                                <button type="button" class="btn btn-primary submitButton">Kayıt Ol</button>
                            </div>



                        </form>

                    <div class="hidden">
                        <div class="ticariForm ">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Şirket Bilgileri</h3>
                                </div>
                            </div>

                            <div class="md-form{{ $errors->has('unvan') ? ' has-error' : '' }}">
                                <i class="fas fa-building prefix"></i>
                                <input type="text" id="unvan" name="unvan" class="form-control validate" value="" autofocus>
                                <label for="unvan" data-error="Geçersiz" data-success="Geçerli">Yasal Şirket Ünvanı</label>
                                @if ($errors->has('unvan'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('unvan') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="md-form {{ $errors->has('vergi') ? ' has-error' : '' }}">
                                <i class="fas fa-briefcase prefix"></i>
                                <input type="text" id="vergi" name="vergi" class="form-control validate" value="" autofocus>
                                <label for="vergi" data-error="Geçersiz" data-success="Geçerli">Vergi Dairesi</label>
                                @if ($errors->has('vergi'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('vergi') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="md-form {{ $errors->has('vergino') ? ' has-error' : '' }}">
                                <i class="far fa-file-alt prefix"></i>
                                <input type="text" id="vergino" name="vergino" class="form-control validate" value="" autofocus>
                                <label for="vergino" data-error="Geçersiz" data-success="Geçerli">Vergi Numarası</label>
                                @if ($errors->has('vergino'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('vergino') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Firma Temsilcisi</h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
        </div>
        </div>


        @include('front.layouts.singlePageStatic')


        @stop

        @section('footer_script')
            <script src="{{ asset('fr/js/post.js') }}" type="text/javascript"></script>
            <script>
                $('input[name=vergilevhasi]').change(function() {
                   alert('aa'+$(this).val());
                });

                $(document).on('click', '.submitButton', function(e) {
                    var vergilevhasi = $('input[name=vergilevhasi]')[0].files[0];
                    var firmatemsilcisitc = $('input[name=firmatemsilcisitc]')[0].files[0];
                    var formData = new FormData($('#registerForm')[0]);

                    ajaxPost($(this).parents('form').attr('action'),register,formData);

                    /*formClear($(this));*/
                });

                function register(data) {
                    window.location.href = "/kullanici/telefon-dogrulama";
                }
               $(document).ready(function() {
                   $( "input[name=select]" ).change(function() {
                       if($(this).val() == 1) {
                           $('form[name=signup] .ticariForm').remove();
                           $('form[name=signup] .evraklar').remove();
                           $('#select1').attr('checked','checked');
                           $('#select2').removeAttr('checked');
                       } else if($(this).val() == 2) {
                           var ticari = $('.ticariForm').clone();
                           $('.ticari').append(ticari);

                           var evraklar = '<div class="ticariEvraklar ">'
                             +'<div class="custom-mykask-file">'
                             +'<input type="file" name="vergilevhasi" class="form-control" id="vergilevhasi" required>'
                            +'</div>'
                            +'<div class="custom-mykask-file">'
                             +'<input type="file" name="firmatemsilcisitc" class="form-control" id="firmatemsilcisitc" required>'
                            +'</div>'
                            +'</div>';
                           $('.evraklar').append(evraklar);
                           $('#select2').attr('checked','checked');
                           $('#select1').removeAttr('checked');
                       } else {
                           alert('hata');
                       }
                   });
               });


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