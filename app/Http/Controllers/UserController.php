<?php

namespace App\Http\Controllers;

use App\CarBrand;
use App\CarModel;
use App\City;
use App\Logic\Functions\Functions;
use App\Logic\Terms\TermsRepository;
use App\Models\Terms;
use App\Pocket;
use App\Policy;
use App\User;
use App\UserCars;
use App\UserCarsRelationships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

	public function home() {
		$users[] = Auth::user();
		$users[] = Auth::guard()->user();
		$users[] = Auth::guard('user')->user();


		return view('user.home', array(
			'title'            	=> 'Araç Ekle',
		));
	}

	public function profile() {

		$user = User::where('id','=',Auth::user()->id)->first();
		//$city = City::all();
		return view('user.profilePage', array(
			'title'            => 'Hesabım',
			'user'            => $user,
		));
	}

	public function profileUpdate(Request $request) {

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = User::profileUpdate($inputs);

		return $response;

	}

	public function profileDelete(Request $request) {

		$response = User::profileDelete();

		return $response;

	}

}
