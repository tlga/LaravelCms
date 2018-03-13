<?php
namespace App\Logic\Terms;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use \App\Models\Terms;
use App\Models\TermRelationships;
use App\Models\TermTaxonomy;
use App\Logic\Functions\Functions;
class TermsRepository
{



	public function tagsave($inputs) {
		$validator = Validator::make($inputs, Terms::$rules, Terms::$messages);
		if ($validator->fails()) {
			return Response::json([
				'error' => true,
				'msg' => $validator->messages()->first(),
				'code' => 400
			], 200);
		}



		$terms = new Terms;
		$terms->name       = $inputs['name'];
		$terms->slug 			 = Functions::permalink($inputs['name']);
		$terms->term_group = 1;
		$terms->save();

		$termTaxonomy = new TermTaxonomy;
		$termTaxonomy->term_id = $terms->id;
		$termTaxonomy->term_taxonomy_id = $terms->id;
		$termTaxonomy->parent 			= null;
		$termTaxonomy->taxonomy = 'etiket';
		$termTaxonomy->save();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Etiket ekleme işlemi başarılı.',
			'tag'	=> $terms->name,
			'tagid'	=> $terms->id,
		], 200);
	}
	/*public static function getSubCategory($id = 0, $string = 0) {
		$query = Terms::where('parent','=',$id)->get();

		if($query) {
			foreach($query as $querys) {
				echo '<li>'.str_repeat("-",$string).$querys["name"].'</li>';
				$this->getSubCategory($querys['id'],$string + 2);
			}
		} else {
			echo 'false';
		}
	}*/

	public function save($inputs) {
		$validator = Validator::make($inputs, Terms::$rules, Terms::$messages);
		if ($validator->fails()) {
			return Response::json([
				'error' => true,
				'msg' => $validator->messages()->first(),
				'code' => 400
			], 200);
		}

		$terms = new Terms;
		$terms->name       = $inputs['name'];
		$terms->slug 			 = Functions::permalink($inputs['name']);
		$terms->term_group = 0;
		$terms->save();

		$termTaxonomy = new TermTaxonomy;
		$termTaxonomy->term_id = $terms->id;
		$termTaxonomy->term_taxonomy_id = $terms->id;
		$termTaxonomy->parent 			= $inputs['parent'];
		$termTaxonomy->taxonomy = 'category';
		$termTaxonomy->description = $inputs['description'];
		$termTaxonomy->save();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Kategori ekleme işlemi başarılı.'
		], 200);
	}

	public function saved($inputs) {
		$validator = Validator::make($inputs, Terms::$rules, Terms::$messages);
		if ($validator->fails()) {
			return Response::json([
				'error' => true,
				'msg' => $validator->messages()->first(),
				'code' => 400
			], 200);
		}

		$terms = new Terms;
		$terms->name       = $inputs['name'];
		$terms->slug 			 = Functions::permalink($inputs['name']);
		$terms->term_group = 1;
		$terms->save();

		$termTaxonomy = new TermTaxonomy;
		$termTaxonomy->term_id = $terms->id;
		$termTaxonomy->term_taxonomy_id = $terms->id;
		$termTaxonomy->taxonomy = 'etiket';
		$termTaxonomy->save();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Kategori ekleme işlemi başarılı.'
		], 200);
	}

	public function delete($inputs) {

		Terms::whereIn('id',$inputs['selectedRows'])->delete();

		TermTaxonomy::whereIn('term_id',$inputs['selectedRows'])->delete();

		return Response::json([
			'error' => false,
			'code'  => 200,
			'msg'	=>	'Kategori silme işlemi başarılı.'
		], 200);

	}

}