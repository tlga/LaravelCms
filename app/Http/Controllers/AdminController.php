<?php

namespace App\Http\Controllers;

use App\CarBrand;
use App\CarModel;
use App\City;
use App\Logic\Terms\TermsRepository;
use App\Models\Terms;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Admin;
use Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Models\Post;
use Auth;
class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */


	public function home() {
		$users[] = Auth::user();
		$users[] = Auth::guard()->user();
		$users[] = Auth::guard('admin')->user();

		//dd($users);

		return view('panel.home', array(
			'title'            => 'Aura Agency Site Yönetim Paneli',
		));
	}

	public function userProcess($auth= '',$id = '') {
		if($id == '') {
			return view('panel.users', array(
				'title'            => 'Kullanıcı Düzenle',
			));
		} else {
			if($id == 0) {
				$data['title'] = 'Site yöneticisi üzerinde değişiklik yapmanıza izin verilmiyor!';
				$data['name'] = 'Süper yönetici üzerinde değişiklik yapmanıza izin verilmiyor!';
				return response()
					->view('panel.404',$data,404);

			}

			switch($auth) {
				case 'user':
					$user = User::where('id','=',$id)->first(); break;
				case 'admin':
					$user = Admin::where('id','=',$id)->first(); break;
				default:
					echo 'ok';
			}

			$name = $user->name;
			$email = $user->email;

			return view('panel.users', array(
				'title'            => 'Kullanıcı İşlemleri',
				'userId'           => $id,
				'auth'           => $auth,
				'name'           => $name,
				'email'           => $email,
			));
		}
	}

	public function userEdit(Request $request,$auth,$id) {

		switch($auth) {
			case 'user':
				$userEdit = User::find($id); break;
			case 'admin':
				$userEdit = Admin::find($id); break;
			default:
				echo 'ok';
		}

		$userEdit->name       = $request['adsoyad'];
		$userEdit->email      = $request['email'];
		if(!empty($request['password'])) {
			$userEdit->password      = Hash::make($request['password']);
		}
		$userUpdate = $userEdit->save();

		if($userUpdate) {
			return Response::json([
				'error' => false,
				'code'  => 200,
				'msg'	=>	$auth.' bilgileri değiştirildi.'
			], 200);
		}

		return Response::json([
			'error' => true,
			'code'  => 400,
			'msg'	=>	'Üzgünüz bir problem oluştu!'
		], 200);

	}

	public function userDelete(Request $request,$auth,$id) {

		switch($auth) {
			case 'user':
				$userEdit = User::find($id); break;
			case 'admin':
				$userEdit = Admin::find($id); break;
			default:
				echo 'ok';
		}

		$userUpdate = $userEdit->delete();

		if($userUpdate) {
			return Response::json([
				'error' => false,
				'code'  => 200,
				'msg'	=>	$auth.' silindi.'
			], 200);
		}

		return Response::json([
			'error' => true,
			'code'  => 400,
			'msg'	=>	'Üzgünüz bir problem oluştu!'
		], 200);

	}

	public function uploadFile() {

		$uploadedFile = Image::where('setting','>',3)->get();

		return view('panel.uploadFile', array(
			'title'            => 'Dosya Yükle',
			'uploadedFile'     => $uploadedFile,
		));
	}


	public function slider() {

		$slider = Slider::all();

		return view('panel.slider', array(
			'title'            => 'Slider İşlemleri',
			'slider'            => $slider,
		));
	}

	public function sliderSave(Request $request) {
		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = Slider::sliderSaveMethod($inputs);

		return $response;
	}

	public function sliderEdit(Request $request) {
		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = Slider::sliderEditMethod($inputs);

		return $response;
	}

	public function sliderDelete(Request $request) {

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = Slider::sliderDeleteMethod($inputs);

		return $response;

	}

	public function carDataPush() {
		$typeCode = array(

		);

		$city = array(
			'Adana',
		);
		$id = 1;
		for($i=0; $i <= 82; $i++) {
			/*City::where('id','=',$id)->update(array(
				'2018'	=> $typeCode[$i],
			));*/
			City::insertGetId(array(
				'city_name' => $city[$i],
			));
		}
		/*	echo $id.'inserted!<br/>';
			$id++;

		}
		echo 'Tamamlandı!';
		/*foreach($markaKodu as $marka) {
			echo $marka."<br/>";
			$i = 1;
			CarBrand::insertGetId(array(
				'brand_code'	=> $marka,
				'brand_type'	=> $markaTipi[$i],
			));
			$i++;

		}*/

		/*$count = 1;
		foreach($markaKodu as $marka) {
			$content = array(
				'2017' => $marka
			);
			$arac = KaskoBedel::where('kaskobedel_id','=',$count);
			$arac->update($content);
			if($count != 19383) {
				$count++;
			}
		}

		/*foreach($markaKodu as $marka) {
			$content = array(
				'arac_tip_kodu' => $marka
			);
			$arac = AracMarka::where('arac_id','=',$count);
			$arac->update($content);
			if($count != 141) {
				$count++;
			}
		}*/

	}

}
