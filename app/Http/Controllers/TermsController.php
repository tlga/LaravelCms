<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Terms;
use Illuminate\Support\Facades\Input;
use Datatables;
use App\Logic\Terms\TermsRepository;
use App\Models\TermTaxonomy;
use App\Logic\Functions\Functions;
use Illuminate\Support\Facades\Response;
class TermsController extends Controller
{
	protected $terms;

	public function __construct(TermsRepository $termsRepository)
	{
		$this->terms = $termsRepository;
	}

	/*public function getUpload()
	{
		return view('pages.upload');
	}*/

	public function categories()
	{
		return view('panel.categories', array(
			'title'            => 'Kategoriler',
		));
	}

	public function tags()
	{
		return view('panel.tags', array(
			'title'            => 'Etiketler',
		));
	}

	public function categoryGet() {
		return Terms::select('name','id','term_id','parent','count')->leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')->where('term_taxonomy.taxonomy','=','category')->get();

	}

	public function tagsGet() {
		return Terms::select('name','id','term_id','parent','count','taxonomy')->leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')->where('term_taxonomy.taxonomy','=','etiket')->get();

	}

	public function getCategory()
	{
		$terms = DB::table('terms')->select('terms.name','term_taxonomy.description','term_taxonomy.count','terms.id')
			->leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')
			->leftJoin('term_relationships','term_relationships.term_taxonomy_id','=','term_taxonomy.term_taxonomy_id')
			->where('term_taxonomy.taxonomy','=','category')
			->groupBy('terms.id')
			->get();

		return Datatables::of($terms)
			->make(true);
	}

	public function getTags()
	{
		$terms = DB::table('terms')->select('terms.name','term_taxonomy.description','term_taxonomy.count','terms.id')
			->leftJoin('term_taxonomy','term_taxonomy.term_id','=','terms.id')
			->leftJoin('term_relationships','term_relationships.term_taxonomy_id','=','term_taxonomy.term_taxonomy_id')
			->where('term_taxonomy.taxonomy','=','etiket')
			->get();

		return Datatables::of($terms)
			->make(true);
	}

	public function saveCategory(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->terms->save( $inputs );

		return $response;
	}

	public function savedTags(Request $request)
	{

		$inputs = $request->all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->terms->saved( $inputs );

		return $response;
	}

	public function deleteCategory()
	{

		$inputs = Input::all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->terms->delete( $inputs );

		return $response;
	}

	public function deleteTags()
	{

		$inputs = Input::all();

		if(!$inputs)
		{
			return 0;
		}

		$response = $this->terms->delete( $inputs );

		return $response;
	}

	public function savetags(Request $request) {

		$inputs = $request->all();

		if(!$inputs['name'])
		{
			return 0;
		}

		$tagControll = Terms::select('name','slug','id')->where('slug', 'like', '%'.Functions::permalink($inputs['name']).'%')
			->first();

		if(!empty($tagControll)) {
			return Response::json([
				'error' => false,
				'code'  => 200,
				'msg'	=>	'Etiket mevcut.',
				'tag'	=> $tagControll->name,
				'tagid'	=> $tagControll->id,
			], 200);
		}

		$response = $this->terms->tagsave( $inputs );

		return $response;

	}
	

}
