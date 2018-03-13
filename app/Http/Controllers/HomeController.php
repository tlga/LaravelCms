<?php

namespace App\Http\Controllers;

use App\CarBrand;
use App\City;
use App\Logic\Functions\Functions;
use App\Logic\Terms\TermsRepository;
use App\Models\Slider;
use App\Models\Terms;
use App\Pocket;
use App\Service;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use File;
use Mail;
use Auth;

class HomeController extends Controller
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



	public function single($slug='')
	{

		if($slug == '') {

			return view('front.home', array(
				'title'            => '',
			));
		}

		$singleContent = Post::where('post_slug','=',$slug)->first();

		if(!empty($singleContent)) {
			$featuredCheck = Image::where('id','=',$singleContent->post_featured)->first();
			if($featuredCheck) {
				$featured = $featuredCheck->filename;
			} else {
				$featured = null;
			}

			return view('front.single', array(
				'title'            => $singleContent->post_title,
				'author'      		 => $singleContent->post_author,
				'content'      		 => $singleContent->post_content,
				'userForm'      		 => $singleContent->user_form,
				'slug'      		 	 => $singleContent->post_slug,
				'featured'      	 => $featured,
				'menu'      		 	 => $singleContent->menu_order,
			));
		}

		return view('front.notFound', array(
				'title'		=> 'Aradığınız sayfaya ulaşılamıyor!',
		));

	}

	public function notfound() {
		return view('front.notFound', array(
			'title'		=> 'Aradığınız sayfaya ulaşılamıyor!',
		));
	}

	public function blog($slug='',$article='')
	{

		$related = Post::where('post_type','=',2)->limit(5)->get();

		if($slug == '' && $article == '') {

			$post = Post::where('post_type','=',2)->paginate(5);

			return view('front.blog', array(
				'title'            => $slug,
				'post'            	=> $post,
				'related'            	=> $related,
			));
		}

		$categoryInfo = Terms::where('slug','=',$slug)->first();
		$categoryName = $categoryInfo->name;
		$categorySlug = $slug;

		if($article == '') {
		/*Kategori Sayfası*/
			$post = Post::select('*','posts.id as post_id')
				->leftJoin('term_relationships','posts.id','=','term_relationships.object_id')
				->leftJoin('terms','term_relationships.term_taxonomy_id','=','terms.id')
				->where('terms.slug','=',$slug)
				->groupBy('posts.id')
				->paginate(5);

			return view('front.blog', array(
				'title'            => $categoryName,
				'post'      	 => $post,
				'related'      	 => $related,
			));

		}

		$articles = Post::where('post_slug','=',$article)->first();

		$featuredCheck = Image::where('id','=',$articles->post_featured)->first();
		if($featuredCheck) {
			$featured = $featuredCheck->filename;
		} else {
			$featured = null;
		}

		return view('front.blogSingle', array(
			'title'            => $articles->post_title,
			'id'               => $articles->id,
			'author'      		 => $articles->post_author,
			'content'      		 => $articles->post_content,
			'userForm'      	 => $articles->user_form,
			'slug'      		 	 => $articles->post_slug,
			'featured'      	 => $featured,
			'menu'      		 	 => $articles->menu_order,
			'categoryName'     => $categoryName,
			'categorySlug'     => $categorySlug,
			'related'     		 => $related,
		));
	}

	public function iletisimPost(Request $request) {

		$data = $request->all();

		$v = Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255',
			'phone' => 'required',
			'subject' => 'required',
			'message' => 'required',
		], [
			'name.required' => 'Ad soyad alanını doldurmak zorundasınız!',
			'name.max' => 'Ad soyad alanı en fazla 255 karakter olabilir!',
			'email.required' => 'Email alanını doldurmak zorundasınız!',
			'email.email' => 'Email formatı geçersiz!',
			'email.max' => 'Email maksimum 255 karakter olabilir!',
			'phone.required' => 'Telefon alanını girmek durumundasınız!',
			'subject.required' => 'Konu alanını doldurmak zorundasınız!',
			'message.required' => 'Mesaj alanını doldurmak zorundasınız!',
		]);

		if( $v->fails() ) {
			$mesajlar = $v->messages();
			$htmlMesaj = '';
			foreach ($mesajlar->all('<li>:message</li>') as $mesaj)
			{
				$htmlMesaj .= $mesaj;
			}
			return Response::json([
				'error' => true,
				'status' => false,
				'msg' => $htmlMesaj,
				'code' => 400
			], 200);
		}

		if ( $v->passes() ) {

			$data = [
				'name'       			=> $data['name'],
				'email'       		=> $data['email'],
				'phone'       		=> $data['phone'],
				'subject'       	=> $data['subject'],
				'message'       	=> $data['message'],
			];

			Mail::send('mail.iletisim',$data,function($message) use ($data){
				$message->from('no-reply@mykask.com','MyKask.com İletişim Talebi');
				$message->to('info@mykask.com');
				$message->subject('MyKask İletişim Talebi - '.$data['name']);
			});

			return Response::json([
				'error' => false,
				'status' => true,
				'redirect' => '/iletisim',
				'msg' => 'Teşekkürler talebiniz alındı.',
				'code' => 200
			], 200);

		}
	}


}
