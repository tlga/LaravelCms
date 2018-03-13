<?php

namespace App\Http\Controllers;

use App\Logic\Pages\PagesRepository;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Datatables;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Response;
use App\Models\Post;
use App\Models\Image;
class PageController extends Controller
{
	protected $page;

	public function __construct(PagesRepository $pageRepository)
	{
		$this->page = $pageRepository;
	}

	public function pageProcess($id='')
	{

		if($id == '') {
			return view('panel.newPage', array(
				'title'            => 'Sayfa Oluştur',
			));
		}

		$page = Post::where('id','=',$id)->first();

		if(empty($page)) {
			$data['title'] = '404 Sayfa Bulunamadı!';
			$data['name'] = 'Üzgünüz böyle bir sayfa yok veya tamamen kaldırılmış olabilir. Destek İçin support@auramedya.com adresine mail gönderebilirsiniz.';
			return response()
				->view('panel.404',$data,404);

		} else {

			if($page->post_featured != 0) {
				$featured = Image::where('id','=',$page->post_featured)->first()->filename;
			} else {
				$featured = null;
			}

			return view('panel.newPage', array(
				'title'            => 'Sayfa Düzenle',
				'post_id'            => $page->id,
				'post_title'            => $page->post_title,
				'post_content'            => $page->post_content,
				'userForm'            => $page->user_form,
				'post_featured'            => $featured,
				'post_featured_id'            => $page->post_featured,
			));

		}

	}

	public function allPage()
	{

			return view('panel.pageTable', array(
				'title'            => 'Tüm Sayfalar',
			));

	}

	public function newPageSave(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->page->save( $inputs );

		return $response;
	}

	public function pageEdit(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->page->edit( $inputs );

		return $response;
	}

	public function pageDelete($id)
	{

		if(!$id)
		{
			return 0;
		}

		$response = $this->page->delete( $id );

		return $response;
	}

}
