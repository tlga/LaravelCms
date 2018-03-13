<?php

Route::get('/', ['as' => 'index', 'uses' =>'HomeController@single']);

Route::get('/{slug?}', ['as' => 'single', 'uses' =>'HomeController@single']);

Route::get('/hata/sayfa-bulunamadi', ['as' => 'notfound', 'uses' =>'HomeController@notfound']);

Route::get('yazilar/blog/{slug?}/{article?}', ['as' => 'blog', 'uses' =>'HomeController@blog']);

Auth::routes();

    Route::get('panel/logout', function () {
      return view('login');
    });

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', ['as' => 'admin.login', 'uses' =>'AdminAuth\LoginController@showLoginForm']);
  //Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

});

Route::group(['prefix' => 'user'], function () {
  Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'UserAuth\LoginController@login');
  Route::post('/logout', 'UserAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'UserAuth\RegisterController@register');

  Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
});
