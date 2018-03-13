<?php

namespace App\Http\Controllers;

use App\Logic\Functions\Functions;
use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\Input;
use App\Models\Image;
use Validator;
use Response;
class ImageController extends Controller
{
	protected $image;

	public function __construct(ImageRepository $imageRepository)
	{
		$this->image = $imageRepository;
	}

	/*public function getUpload()
	{
		return view('pages.upload');
	}*/

	public function imageLibrary()
	{
		return view('panel.imageLibrary', array(
			'title'            => 'Ortam Kütüphanesi',
		));
	}

	public static function fileUpload() {
		$messages = '';
		$t = [];
		$i = 0;

		try
		{
			//dosyanın yükleneceği dizin
			$destinationPath = public_path('images/user_upload/');
			
			$url = config('app.url');

			//dd($url);
			$input = array(
				'files'=>Input::file('files'),
				'type'=>Input::get('type'),
				'max'=>1,
			);

			$pic_name = Input::get('isim');
			if ($pic_name) {
				$isim = rand(0,99999)."-".Functions::permalink($pic_name);
			} else {
				$isim = md5(uniqid('', true) );
			}


			$files  = array( $input['files']);
			$type   = $input['type'];
			$maxFile = $input['max'];
			$status = array();

			if( !is_array($files) )
				return ['status'=>false, 'msg'=> 'En az bir dosya gerekli!' ];

			if(count($files)>$maxFile)
				return ['status'=>false, 'msg'=> 'Max upload file count' ];
			


			//dd($files);

			foreach($files as $file) {
				$t[]['org_name'] = $file->getClientOriginalName();
				$t[$i]['extension'] = $file->getClientOriginalExtension();
				$t[$i]['remote_name'] = $isim . '.' . $t[$i]['extension'];
				$t[$i]['remote_full_name'] = $url . '/images/user_upload/' . $t[$i]['remote_name'];
				$t[$i]['path'] = $destinationPath;

				$t[$i]['remote_name'] = $isim . '.' . $t[$i]['extension'];
				$validator = Validator::make(array('file'=> $file), Image::$rules, Image::$messages, ['file'=>$file->getClientOriginalName()]);

				if ( $validator->passes() ) {

					$t[$i]['info'] = '<li>' . $file->getClientOriginalName() . ' bu fotoğraf yüklendi.' . '</li>';
					$t[$i]['result'] = true;
					$t[$i]['remote_full_name'] = $url . '/images/user_upload/' . $t[$i]['remote_name'];

					/*insert db*/
					$fId = Image::insertPicture($t[$i]['org_name'], $t[$i]['remote_name']);
					$t[$i]['id'] = $fId;
					if($fId) {
						//her basarili dosya yukleme de status e 1 ekliyoruz
						$status[] = 1;
						if (!file_exists($destinationPath)) {
							mkdir($destinationPath, 0777, true);
						}
						$file->move($destinationPath, $t[$i]['remote_name'] );
					}
				} else {
					$t[$i]['result'] = false;
					$mesajlar = $validator->messages();
					$htmlMesaj = '';
					foreach ($mesajlar->all('<li>:message</li>') as $mesaj)
					{
						$htmlMesaj .= $mesaj;
					}
					$t[$i]['info'] = $htmlMesaj;
				}

				$messages .= $t[$i]['info'];
				$i++;
			}

			//icinde 1 varsa true
			$status = in_array(1, $status);
		}
		catch (Exception $e)
		{

			return ['status'=>false, 'msg'=> $messages . '<li>' . $e->getMessage() . '</li>',  ];

		}


		return ['status'=>$status, 'msg'=> $messages, 'data' => $t[0] ];
	}

	public function postUpload()
	{

		if(strlen(Input::get('archive') > 0)) {
			$destinationPath = public_path() . '/images/user_upload/';
			$uniqeName = 'file'.rand(0,9999999).".".Input::file('file')->getClientOriginalExtension();
			Input::file('file')->move($destinationPath, $uniqeName );

			$sessionImage = new Image;
			$sessionImage->type      		 = 2;
			$sessionImage->filename      = $uniqeName;
			$sessionImage->original_name = Input::file('file')->getClientOriginalName();
			$sessionImage->save();

			return Response::json([
				'error' => false,
				'code'  => 200,
				'type' => 1,
				'filename' => $uniqeName,
				'id' => $sessionImage->id,
				'msg'	=>	'Dosya ekleme işlemi başarılı.'
			], 200);
		}

		if(Input::file('files') || Input::file('image')) {
			return self::fileUpload();
		}

		if(Input::get('options')[0] == 0 && !empty(Input::get('mediaUrl'))) {
			$beginUrl = Input::get('mediaUrl');

				if ($this->image->is_image($beginUrl) == false)
					return ['status' => false, 'msg' => "Üzgünüz ama bunun bir fotoğraf olduğundan gerçekten eminmisiniz ?",];


			$path = $_SERVER['DOCUMENT_ROOT'] . 'images/';
			$origName = basename($beginUrl);
			list($width, $height) = getimagesize($beginUrl);
			$image_p = imagecreatetruecolor($width, $height);

			$ext = pathinfo($path . $origName, PATHINFO_EXTENSION);
			switch ($ext) {
				case 'jpg':
				case 'jpeg':
					$image = imagecreatefromjpeg($beginUrl);
					break;
				case 'gif':
					/*$url = $beginUrl;*/
					$gifName = md5(uniqid('', true));
					$image = $path . $gifName . ".gif";
					/*$saving = file_put_contents($image, file_get_contents($url));

					$savingMedium = file_put_contents($path . $gifName . ".gif", file_get_contents($url));
					$savingThumb = file_put_contents($path . $gifName . ".gif", file_get_contents($url));*/

					break;
				case 'png':
					$image = imagecreatefrompng($beginUrl);
					break;
			}

			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
			header('Content-Type: image/jpeg');
			imagejpeg($image_p, $path . $origName, 100);
			imagedestroy($image_p);

			$photo = array(
				'name' => $origName,
				'filename'	=> 	$path . $origName,
				'ext'		=>	$ext,
			);

			$url = true;

		} else {
			$photo = Input::all();
			$url = false;
		}

		$response = $this->image->upload($photo,$url);
		return $response;

	}

	public function postVideo() {
		$url = Input::get('mediaUrl');

		if(!$url)
		{
			return 0;
		}

		$response = $this->image->video( $url);

		/*DB::table('image')->insertGetId([
			'filename'	=> $response['urls'],
			'original_name'	=> $response['original']
		]);*/
		Image::insertGetId([
			'filename'	=> $response['urls'],
			'original_name'	=> $response['orgUrl'],
			'type'	=> 1,
			'updated_at'	=> date('Y-m-d H:i:s', time()),
			'created_at'	=> date('Y-m-d H:i:s', time()),
		]);

		return $response;
	}

	public function deleteUpload($galleryIds='')
	{

		$filename = Input::get('id');

		if(!$filename && $galleryIds == '')
		{
			return 0;
		}

		$response = $this->image->delete( $filename, $galleryIds );

		return $response;
	}
	
	

}
