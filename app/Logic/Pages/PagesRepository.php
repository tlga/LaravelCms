<?php
namespace App\Logic\Pages;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Auth;
class PagesRepository
{

	public function save($inputs) {
		$validator = Validator::make($inputs, Post::$rules, Post::$messages);
		if ($validator->fails()) {
			return Response::json([
				'error' => true,
				'msg' => $validator->messages()->first(),
				'code' => 400
			], 200);
		}

		if(isset($inputs['featured'])) {
			$featured = $inputs['featured'];
		} else {
			$featured = 0;
		}

		$posts = new Post;
		$posts->post_title       = $inputs['title'];
		$posts->post_author      = Auth::user()->id;
		$posts->post_content      = addslashes(trim($inputs['content']));
		$posts->user_form      = $inputs['userForm'];
		$posts->post_slug 	= Functions::permalink($inputs['title']);
		$posts->post_featured 	= $featured;
		$posts->menu_order 	= 1;
		$posts->post_type 	= '1';
		$posts->created_at 	= time();
		$posts->updated_at 	= time();
		$posts->save();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Sayfa ekleme işlemi başarılı.'
		], 200);
	}

	public function edit($inputs) {
		$validator = Validator::make($inputs, Post::$rules, Post::$messages);
		if ($validator->fails()) {
			return Response::json([
				'error' => true,
				'msg' => $validator->messages()->first(),
				'code' => 400
			], 200);
		}

		if(isset($inputs['featured'])) {
			$featured = $inputs['featured'];
		} else {
			$featured = 0;
		}

		$posts = Post::find($inputs['post_id']);
		$posts->post_title       = $inputs['title'];
		$posts->post_author      = Auth::user()->id;
		$posts->post_content      = addslashes(trim($inputs['content']));
		$posts->user_form      = $inputs['userForm'];
		$posts->post_slug 	= Functions::permalink($inputs['title']);
		$posts->post_featured 	= $featured;
		$posts->menu_order 	= 1;
		$posts->post_type 	= 1;
		$posts->updated_at 	= time();
		$posts->save();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Sayfa güncelleme işlemi başarılı.'
		], 200);
	}

	public function delete($id) {

		Post::where('id','=',$id)->delete();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Sayfa silme işlemi başarılı.'
		], 200);

	}


}