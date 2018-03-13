<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Image;
use Datatables;
use App\Models\Terms;
use App\Models\Post;
class PostController extends Controller
{
    public function articlePost() {
			return ['status' => false, 'errors'	=> 'hatalar şunlar', 'msg' => 'mesaj', 'data' => 'datalar'];
		}

		public function jsonDatas() {

			return Image::all()->toJson();

		}

	public function getPosts()
	{
		$images = DB::table('images')->select('*')->orderBy('id','desc');
		return Datatables::of($images)
			->make(true);
	}
	
	public function pageData()
	{
		$page = DB::table('posts')->select('id','post_title','post_type','post_slug')->where('post_type','=',1)->orderBy('id','desc');
		return Datatables::of($page)
			->make(true);
	}

	public function articleData()
	{
		$article = DB::table('posts')->select('id','post_title','post_type','post_slug')->where('post_type','=',2)->orderBy('id','desc');
		return Datatables::of($article)
			->make(true);
	}

	public function imageGet($skip=0,$take=0)
	{
		$images = DB::table('images')->where('type','!=',2)->skip($skip)->take($take)->orderBy('id','desc')->get();
		return $images;

	}





	public function urlPhoto() {
		$url = Input::get('mediaUrl');

	}






}
