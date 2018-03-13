<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	//protected $table = 'images';
	public $timestamps = false;

	public static $rules = [
		'file' => 'required|mimes:png,gif,jpeg,jpg,zip,rar,pdf,doc,docx,xls,xlsx,psd,odt|max:8192',
	];
	public static $messages = [
		'file.mimes' => 'Yüklenen dosya kabul edilen dosya türleri arasında yer almıyor. Bkz.:png, gif, jpeg, jpg, zip, rar, pdf, doc, docx, xls, xlsx, psd',
		'file.required' => 'Fotoğraf gerekli.',
		'file.max' => 'Maksimum yükleme boyutu 8mb.',
	];

	public static function insertPicture($orgName, $name)
	{
		return self::insertGetId( array(
			'original_name'           => $orgName,
			'filename'         => $name,
			'type'         => 2,
			'updated_at'         => date('Y-m-d H:i:s',time()),
			'created_at'         => date('Y-m-d H:i:s',time()),
		) );

	}

	
}