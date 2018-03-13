<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Response;
class Slider extends Model
{
	public $timestamps = false;
	
	public static function sliderSaveMethod($inputs) {
		$insertSlider = self::insertGetId(array(
			'image_id'	=> $inputs['image_id'],
			'link'			=> $inputs['link'],
			'order_no'	=> $inputs['order_no'],
			'status'		=> 1,
			'created_at'=> time(),
			'updated_at'=> time(),
		));

		if($insertSlider) {
			return Response::json([
				'error' => false,
				'code'  => 200,
				'reload'  => true,
				'msg'	=>	'Teşekkürler slide görseliniz eklendi.'
			], 200);
		} else {
			return Response::json([
				'error' => true,
				'code'  => 400,
				'msg'	=>	'Üzgünüz kayıt oluşturulurken bir problem oluştu.'
			], 200);
		}

	}

	public static function sliderEditMethod($inputs) {
		$updateSlider = self::where('id','=',$inputs['image_id'])->update(array(
				'link'	=> $inputs['link'],
				'order_no'	=> $inputs['order_no'],
		));

		if($updateSlider) {
			return Response::json([
				'error' => false,
				'code'  => 200,
				'msg'	=>	'Teşekkürler slide görseliniz düzenlendi.'
			], 200);
		} else {
			return Response::json([
				'error' => true,
				'code'  => 400,
				'msg'	=>	'Üzgünüz kayıt düzenlenirken bir problem oluştu.'
			], 200);
		}
	}

	public static function sliderDeleteMethod($inputs) {
		self::where('id','=',$inputs['id'])->delete();
	}
}
