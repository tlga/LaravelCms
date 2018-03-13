<?php

namespace App\Http\Controllers;

use App\Logic\Articles\ArticlesRepository;
use App\Models\TermRelationships;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Datatables;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Response;
use App\Models\Post;
use App\Models\Image;
use App\Models\Terms;
class ArticleController extends Controller
{
	protected $article;

	public function __construct(ArticlesRepository $articlesRepository)
	{
		$this->article = $articlesRepository;
	}

	public function articleProcess($id='')
	{

		if($id == '') {
			$kategoriler = Terms::leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')->where('taxonomy','=','category')->get();

			return view('panel.newArticle', array(
				'title'            => 'Yeni Yazı Oluştur',
				'kategoriler'            => $kategoriler,
			));
		}

		$article = Post::where('id','=',$id)->first();

		if(empty($article)) {
			$data['title'] = '404 Sayfa Bulunamadı!';
			$data['name'] = 'Üzgünüz böyle bir sayfa yok veya tamamen kaldırılmış olabilir. Destek İçin support@auramedya.com adresine mail gönderebilirsiniz.';
			return response()
				->view('panel.404',$data,404);

		} else {

			if($article->post_featured != 0) {
				$featured = Image::where('id','=',$article->post_featured)->first()->filename;
			} else {
				$featured = null;
			}

			$kategoriler = Terms::leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')->where('taxonomy','=','category')->get();

			$selectedCategory = TermRelationships::where('object_id','=',$article->id)->get();


			$tag = TermRelationships::leftJoin('terms','terms.id','=','term_relationships.term_taxonomy_id')
				->leftJoin('term_taxonomy','terms.id','=','term_taxonomy.term_id')
				->where('object_id','=',$id)
				->where('terms.term_group','=',1)
				->get();

			return view('panel.newArticle', array(
				'title'            => 'Yazı Düzenle',
				'kategoriler'            => $kategoriler,
				'selectedCategory'            => $selectedCategory,
				'post_id'            => $article->id,
				'post_title'            => $article->post_title,
				'post_content'            => $article->post_content,
				'post_featured'            => $featured,
				'post_featured_id'            => $article->post_featured,
				'tag'            			=> $tag,
				'status'            			=> $article->status,
			));

		}

	}

	public function allArticle()
	{

			return view('panel.articleTable', array(
				'title'            => 'Tüm Yazılar',
			));

	}

	public function newArticleSave(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->article->save( $inputs );

		return $response;
	}

	public function articleEdit(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->article->edit( $inputs );

		return $response;
	}

	public function articleDelete($id)
	{

		if(!$id)
		{
			return 0;
		}

		$response = $this->article->delete( $id );

		return $response;
	}

}
