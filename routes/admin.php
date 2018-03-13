<?php

Route::get('/panel', ['as' => 'administrator', 'uses' =>'AdminController@home']);

/*Slider İşlemleri Başla*/
Route::get('slider', ['as' => 'slider', 'uses' =>'AdminController@slider']);

Route::post('sliderSave', ['as' => 'sliderSave', 'uses' =>'AdminController@sliderSave']);

Route::post('sliderEdit', ['as' => 'sliderEdit', 'uses' =>'AdminController@sliderEdit']);

Route::post('sliderDelete', ['as' => 'sliderDelete', 'uses' =>'AdminController@sliderDelete']);
/*Slider İşlemleri Bitir*/

/*Dosya İşlemleri Başla*/
Route::get('dosya/yukle', ['as' => 'uploadFile', 'uses' =>'AdminController@uploadFile']);

Route::post('dosya/sec', ['as' => 'uploadSelect', 'uses' =>'AdminController@uploadSelect']);

Route::post('dosya/sil', ['as' => 'uploadDelete', 'uses' =>'AdminController@uploadDelete']);
/*Dosya İşlemleri Bitir*/

/*Kullanıcı Kayıt İşlemleri Başla*/
Route::get('/register', ['as' => 'register', 'uses' =>'AdminAuth\RegisterController@showRegistrationForm']);
Route::post('/register', 'AdminAuth\RegisterController@register');
/*Kullanıcı Kayıt İşlemleri Bitir*/

/*Kullanıcılar*/
Route::get('kullanicilar/{auth?}/{id?}', ['as' => 'userProcess', 'uses' =>'AdminController@userProcess']);

Route::post('kullanicilar/{auth?}/{id?}', ['as' => 'userEdit', 'uses' =>'AdminController@userEdit']);

Route::post('kullanicilar/delete/{auth?}/{id?}', ['as' => 'userDelete', 'uses' =>'AdminController@userDelete']);
/*Kullanıcılar*/

/*Yazı İşlemleri Başla*/

Route::get('yazilar/{id?}', ['as' => 'articleProcess', 'uses' =>'ArticleController@articleProcess']);

Route::post('yeni-yazi-kaydet', ['as' => 'newArticleSave', 'uses' =>'ArticleController@newArticleSave']);

Route::post('yazi-guncelle', ['as' => 'articleEdit', 'uses' =>'ArticleController@articleEdit']);

Route::post('yazi-sil/{id?}', ['as' => 'articleDelete', 'uses' =>'ArticleController@articleDelete']);

Route::get('tum-yazilar', ['as' => 'allArticle', 'uses' =>'ArticleController@allArticle']);

Route::get('datatable/articleData', ['as'=>'datatable.articleData','uses'=>'PostController@articleData']);

/*Yazı İşlemleri Bitir*/


/*Sayfa İşlemleri Başla*/

Route::get('sayfalar/{id?}', ['as' => 'pageProcess', 'uses' =>'PageController@pageProcess']);

Route::post('yeni-sayfa-kaydet', ['as' => 'newPageSave', 'uses' =>'PageController@newPageSave']);

Route::post('sayfa-guncelle', ['as' => 'pageEdit', 'uses' =>'PageController@pageEdit']);

Route::post('sayfa-sil/{id?}', ['as' => 'pageDelete', 'uses' =>'PageController@pageDelete']);

Route::get('tum-sayfalar', ['as' => 'allPage', 'uses' =>'PageController@allPage']);

Route::get('datatable/pageData', ['as'=>'datatable.pageData','uses'=>'PostController@pageData']);

/*Sayfa İşlemleri Bitir*/


/*Kategori İşlemleri Başla*/

Route::get('kategoriler', ['as' => 'categories', 'uses' =>'TermsController@categories']);

Route::post('post/saveCategory', ['as' => 'saveCategory', 'uses' =>'TermsController@saveCategory']);

Route::post('post/deleteCategory', ['as' => 'deleteCategory', 'uses' =>'TermsController@deleteCategory']);

Route::post('getContent/category', ['as'=>'categoryGet','uses'=>'TermsController@categoryGet']);

Route::get('datatable/getCategory', ['as'=>'datatable.getCategory','uses'=>'TermsController@getCategory']);

/*Kategori İşlemleri Bitir*/

/*Etiket İşlemleri Başla*/
Route::post('post/saveTags', ['as' => 'saveTags', 'uses' =>'TermsController@saveTags']);

Route::post('post/deleteTags', ['as' => 'deleteTags', 'uses' =>'TermsController@deleteTags']);

Route::get('etiketler', ['as' => 'tags', 'uses' =>'TermsController@tags']);

Route::post('post/savedTags', ['as' => 'savedTags', 'uses' =>'TermsController@savedTags']);

Route::post('getContent/tags', ['as'=>'tagsGet','uses'=>'TermsController@tagsGet']);

Route::get('datatable/getTags', ['as'=>'datatable.getTags','uses'=>'TermsController@getTags']);

/*Etiket İşlemleri Bitir*/

/*Fotoğraf İşlemleri Başla*/

Route::post('articlePost', array('as' => 'articlePost', 'uses' => 'PostController@articlePost'));

Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);

Route::post('upload/delete/{galleryIds?}', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);

Route::post('upload/video', ['as' => 'upload-video', 'uses' =>'ImageController@postVideo']);

Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);

Route::post('upload/delete/{galleryIds?}', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);

Route::any('jsonDatas', ['as' => 'jsonDatas', 'uses' =>'PostController@jsonDatas']);

Route::get('ortam-kutuphanesi', ['as'=>'imageLibrary','uses'=>'ImageController@imageLibrary']);

Route::get('datatable/getposts', ['as'=>'datatable.getposts','uses'=>'PostController@getPosts']);

Route::get('datatable/getUsers', ['as'=>'datatable.getUsers','uses'=>'PostController@getUsers']);

Route::post('getContent/image/{skip?}/{take?}', ['as'=>'imageGet','uses'=>'PostController@imageGet']);

/*Fotoğraf İşlemleri Bitir*/
