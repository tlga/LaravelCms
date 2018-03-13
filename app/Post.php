<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $timestamps = false;
	
	public static $rules = [
		'title' => 'required'
		//'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
	];
	public static $messages = [
		//'file.mimes' => 'Yüklenen dosya doğru bir fotoğraf formatı değil.',
		'title.required' => 'Başlık alanı gerekli!'
	];

}
