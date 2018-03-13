<?php
namespace App\Logic\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Models\Image;
class ImageRepository
{
	public function upload( $form_data , $url)
	{
		if ($url == false) {
			$validator = Validator::make($form_data, Image::$rules, Image::$messages);
			if ($validator->fails()) {
				return Response::json([
					'error' => true,
					'type' => 1,
					'message' => $validator->messages()->first(),
					'code' => 400
				], 400);
			}

			$photo = $form_data['file'];
			$originalName = $photo->getClientOriginalName();
			$extension = $photo->getClientOriginalExtension();
		} else {
			$photo = $form_data['filename'];
			$originalName = $form_data['name'];
			$extension = $form_data['ext'];
		}



		$originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
		$filename = $this->sanitize($originalNameWithoutExt);
		$allowed_filename = $this->createUniqueFilename( $filename, $extension );
		if(isset($form_data['archive'])) {
			$uploadSuccess1 = $this->userUpload( $photo, $allowed_filename );
			$uploadSuccess2 = true;
		} else {
			$uploadSuccess1 = $this->original( $photo, $allowed_filename );
			$uploadSuccess2 = $this->icon( $photo, $allowed_filename );
		}

		if( !$uploadSuccess1 || !$uploadSuccess2 ) {
			return Response::json([
				'error' => true,
				'message' => 'Server error while uploading',
				'code' => 500
			], 500);
		}
		$sessionImage = new Image;
		$sessionImage->filename      = $allowed_filename;
		$sessionImage->type      = 0;
		$sessionImage->original_name = $originalName;
		$sessionImage->save();

		$type = 1;

		return Response::json([
			'error' => false,
			'code'  => 200,
			'type' => $type,
			'id' => $sessionImage->id,
			'filename' => $allowed_filename,
			'msg'	=>	'Medya ekleme işlemi başarılı.'
		], 200);
	}
	public function createUniqueFilename( $filename, $extension )
	{
		$full_size_dir = Config::get('app.full_size');
		$full_image_path = $full_size_dir . $filename . '.' . $extension;
		if ( File::exists( $full_image_path ) )
		{
			// Generate token for image
			$imageToken = substr(sha1(mt_rand()), 0, 5);
			return $filename . '-' . $imageToken . '.' . $extension;
		}
		return $filename . '.' . $extension;
	}
	/**
	 * Optimize Original Image
	 */
	public function original( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->save(Config::get('app.full_size') . $filename );
		return $image;
	}

	public function userUpload( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->save(Config::get('app.user_upload') . $filename );
		return $image;
	}
	/**
	 * Create Icon From Original
	 */
	public function icon( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->resize(200, null, function ($constraint) {
			$constraint->aspectRatio();
		})
			->save( Config::get('app.icon_size')  . $filename );
		return $image;
	}
	/**
	 * Delete Image From Session folder, based on server created filename
	 */
	public function delete( $filename ,$galleryIds='')
	{

		$full_size_dir = Config::get('app.full_size');
		$icon_size_dir = Config::get('app.icon_size');
		$user_upload_dir = Config::get('app.user_upload');
		if($galleryIds == '') {
			if(is_numeric($filename)) {
				$sessionImage = Image::where('id', '=', $filename)->first();
			} else {
				$sessionImage = Image::where('filename', 'like', $filename)->first();
			}
		} else {
			$sessionImage = Image::where('id', '=', $galleryIds)->first();
		}
		if(empty($sessionImage))
		{
			return Response::json([
				'error' => true,
				'code'  => 400
			], 400);
		}
		$full_path1 = $full_size_dir . $sessionImage->filename;
		$full_path2 = $icon_size_dir . $sessionImage->filename;
		$user_upload = $user_upload_dir . $sessionImage->filename;
		if ( File::exists( $full_path1 ) )
		{
			File::delete( $full_path1 );
		}
		if ( File::exists( $full_path2 ) )
		{
			File::delete( $full_path2 );
		}
		if ( File::exists( $user_upload ) )
		{
			File::delete( $user_upload );
		}
		if( !empty($sessionImage))
		{
			$sessionImage->delete();
		}
		return Response::json([
			'error' => false,
			'msg'	=> 'Medya kalıcı olarak silindi!',
			'code'  => 200
		], 200);
	}
	function sanitize($string, $force_lowercase = true, $anal = false)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$stringtr = strtolower(str_replace($find, $replace, $string));
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
			"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
			"â€”", "â€“", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($stringtr)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
		return ($force_lowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
	}

	public function video($url) {

		$ytRegExp = "/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";
		preg_match($ytRegExp, $url, $ytMatch);
		if ($ytMatch && strlen($ytMatch[1]) === 11) {
			return ['status' => true,'type' => 2,  'urls' => "//www.youtube.com/embed/{$ytMatch[1]}?showinfo=0", 'orgUrl' => $url];
		}

		// Instagram
		$igRegExp = "/^(?:https?:\/\/)?(?:www\.)?instagram.com\/p\/(.[a-zA-Z0-9\_]*)/";
		preg_match($igRegExp, $url, $igMatch);
		if ($igMatch && strlen($igMatch[0])) {
			return ['status' => true,'type' => 2,  'urls' => "{$igMatch[0]}/embed/", 'orgUrl' => $url];
		}

		// Vine
		$vRegExp = "/^(?:https?:\/\/)?(?:www\.)?vine.co\/v\/(.[a-zA-Z0-9]*)/";
		preg_match($vRegExp, $url, $vMatch);
		if ($vMatch && strlen($vMatch[0])) {
			return ['status' => true,'type' => 2,  'urls' => "{$vMatch[0]}/embed/simple", 'orgUrl' => $url];
		}

		// Vimeo
		$vimRegExp = " /\/\/(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/";
		preg_match($vimRegExp, $url, $vimMatch);
		if ($vimMatch && strlen($vimMatch[3])) {
			return ['status' => true,'type' => 2,  'urls' => "//player.vimeo.com/video/{$vimMatch[3]}", 'orgUrl' => $url];
		}

		// Dailymotion
		$dmRegExp = "/.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/";
		preg_match($dmRegExp, $url, $dmMatch);
		if ($dmMatch && strlen($dmMatch[2])) {
			return ['status' => true,'type' => 2,  'urls' => "//www.dailymotion.com/embed/video/{$dmMatch[2]}", 'orgUrl' => $url];
		}

		// Youku
		$youkuRegExp = "/\/\/v\.youku\.com\/v_show\/id_(\w+)/";
		preg_match($youkuRegExp, $url, $youkuMatch);
		if ($youkuMatch && strlen($youkuMatch[1])) {
			return ['status' => true,'type' => 2,  'urls' => "//player.youku.com/embed/{$youkuMatch[1]}", 'orgUrl' => $url];
		}

		$src = explode('"', $url);
		if (isset($src[1])) {
			if (strpos($src[2], "hurriyet")) { // Hürriyet
				return ['status' => true,'type' => 2,  'urls' => "$src[2]", 'orgUrl' => $url];
			} else if (strpos($src[4], "flowplayer.org")) {// Milliyet
				return ['status' => true,'type' => 2,  'urls' => "$src[4]", 'orgUrl' => $url];
			}
		}

		$count = 0;
		foreach ($src as $findSrc) {

			if (strpos($findSrc, "twitter.com")) {
				return ['status' => true, 'type' => 1, 'urls' => $findSrc, 'orgUrl' => $findSrc];
			} else if (strpos($findSrc, "facebook")) {
				$expld = explode('"', $findSrc);
				$ara = strpos($findSrc, 'www.facebook.com');
				if ($ara == true) {
					return ['status' => true, 'type' => 2, 'urls' => $src[1], 'orgUrl' => $findSrc,'width'=>$src[3],'height'=>$src[5]];
				}
				return ['status' => false, 'msg' => 'Üzgünüz bu tanımlanmış bir içerik türüne benzemiyor!',];
			}

			$ara = strpos($findSrc, 'www.');
			if ($ara == true) {
				return ['status' => true,'type' => 2,  'urls' => "$src[$count]", 'orgUrl' => $url];
			}
			$count++;
		}

		$mp4RegExp = '/^.+.(mp4|m4v)$/';
		preg_match($mp4RegExp, $url, $mp4Match);

		$oggRegExp = '/^.+.(ogg|ogv)$/';
		preg_match($oggRegExp, $url, $oggMatch);

		$webmRegExp = '/^.+.(webm)$/';
		preg_match($webmRegExp, $url, $webmMatch);

		if ($mp4Match || $oggMatch || $webmMatch) {
			return ['status' => true,'type' => 2, 'urls' => $url, 'orgUrl' => $url];
		}


		return ['status' => false,'type' => 2, 'msg' => 'Üzgünüz bu urlyi okuyamadık!',];
	}

	function is_image($path)
	{
		if(substr($path, -3) == 'gif') {
			return 'gif';
		}
		$headers = @get_headers($path, 1); // @ to suppress errors. Remove when debugging.
		if (isset($headers['Content-Type'])) {
			if (strpos($headers['Content-Type'], 'image/') === FALSE) {
				return false;
			} else {
				return true;
			}
		} else {
			if(substr($path, -3) == 'jpg' || substr($path, -3) == 'gif' || substr($path, -3) == 'png' || substr($path, -4) == 'jpeg') return true;
			$mimes = array('bmp' => array('image/bmp', 'image/x-windows-bmp'),
				'gif' => 'image/gif',
				'jpeg' => array('image/jpeg', 'image/pjpeg'),
				'jpg' => array('image/jpeg', 'image/pjpeg'),
				'jpe' => array('image/jpeg', 'image/pjpeg'),
				'png' => array('image/png', 'image/x-png')
			);
			$info = @getimagesize($path);
			if ($info['mime']) {
				if ($type = array_search($info ['mime'], $mimes)) {
					return true;
				} else {
					foreach ($mimes as $key => $value) {
						if (is_array($value)) {
							if (!(FALSE === array_search($info['mime'], $value)))
								return true;
						}
					}
				}//end of else
			} else return false;
		}
		return false;
	}

	public function urlPhoto($form_data) {
		return $form_data;
	}
}