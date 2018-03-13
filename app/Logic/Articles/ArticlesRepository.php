<?php
namespace App\Logic\Articles;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Auth;
use App\Models\TermRelationships;
class ArticlesRepository
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


		$authId = Auth::guard('admin')->user()->id;
		$status = 1;

		$posts = new Post;
		$posts->post_title       = $inputs['title'];
		$posts->post_author      = $authId;
		$posts->post_content      = addslashes(trim($inputs['content']));
		$posts->post_slug 			= Functions::permalink($inputs['title']);
		$posts->post_featured 	= $featured;
		$posts->menu_order 	= 1;
		$posts->post_type 	= 2;
		$posts->created_at 	= time();
		$posts->updated_at 	= time();
		$posts->status			= $status;
		$posts->save();


		if(isset($inputs['kategori'])) {
			$category = $inputs['kategori'];
		} else {
			$category = 14;
		}

		foreach($category as $categorys) {
			$relationship 										= new TermRelationships;
			$relationship->object_id 					= $posts->id;
			$relationship->term_taxonomy_id 	= $categorys;
			$relationship->save();
		}

		if(isset($inputs['etiket'])) {
			$tag = $inputs['etiket'];

			foreach($tag as $tags) {
				$relationship 										= new TermRelationships;
				$relationship->object_id 					= $posts->id;
				$relationship->term_taxonomy_id 	= $tags;
				$relationship->save();
			}
		}

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Yazı ekleme işlemi başarılı.'
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
		$posts->post_slug 	= Functions::permalink($inputs['title']);
		$posts->post_featured 	= $featured;
		$posts->menu_order 	= 1;
		$posts->post_type 	= 2;
		$posts->updated_at 	= time();
		$posts->status 	= 1;
		$posts->save();


		TermRelationships::where('object_id','=',$inputs['post_id'])->delete();

		if(isset($inputs['kategori'])) {
			$category = $inputs['kategori'];

			foreach($category as $categorys) {
				$relationship 										= new TermRelationships;
				$relationship->object_id 					= $posts->id;
				$relationship->term_taxonomy_id 	= $categorys;
				$relationship->save();
			}
		}

		if(isset($inputs['etiket'])) {
			$tag = $inputs['etiket'];

			foreach ($tag as $tags) {
				$relationship = new TermRelationships;
				$relationship->object_id = $posts->id;
				$relationship->term_taxonomy_id = $tags;
				$relationship->save();
			}
		}

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Yazı güncelleme işlemi başarılı.'
		], 200);
	}

	public function delete($id) {

		Post::where('id','=',$id)->delete();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Yazı silme işlemi başarılı.'
		], 200);

	}


}