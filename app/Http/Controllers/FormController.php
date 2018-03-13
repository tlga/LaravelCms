<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class FormController extends Controller
{


	public function iletisimFormSave(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}


		$response = Iletisim::saveForm( $inputs );

		return $response;
	}


}
