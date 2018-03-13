<?php
namespace App\Logic\Functions;

use App\Admin;
use App\CarBrand;
use App\CarModel;
use App\City;
use App\Models\Terms;
use App\Policy;
use App\UserPocketRelationships;
use Illuminate\Support\Facades\Config;
use App\Models\Image;
use App\Models\Post;
use DateTime;
use Auth;
class Functions
{

	public static function howLongAgo($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'yıl',
			'm' => 'ay',
			'w' => 'hafta',
			'd' => 'gün',
			'h' => 'saat',
			'i' => 'dakika',
			's' => 'saniye',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' önce' : 'şimdi';

	}

	public static function getAuthor($authorId) {
		$admin = Admin::where('id','=',$authorId)->first();
		if(!empty($admin)) {
			return $admin->name;
		} else {
			$teacher = Teacher::where('id','=',$authorId)->first();
			return $teacher->name;
		}
	}

	public static function permalink($string)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$string = strtolower(str_replace($find, $replace, $string));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		if(substr($string,-1) == '-') {
			return rtrim($string,'-');
		}
		return $string;
	}

	public static function getImage($imageId = '') {
		if($imageId != '') {
			return Image::where('id','=',$imageId)->first()->filename;
		}
		return 'not-found.png';
	}

	public static function notification() {
		$postNotConfirmCount = Post::where('status','=',0)->get();

		if(!empty($postNotConfirmCount)) {
			foreach($postNotConfirmCount as $posts) {
				echo '<div class="m-list-timeline__item">
							<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
								<span class="m-list-timeline__text">
									<a href="'.route("admin.articleProcess").'/'.$posts->id.'">1 yeni yazı girildi.</a>
								</span>
								<span class="m-list-timeline__time">
									'.self::howLongAgo(date('Y-m-d H:i:s',$posts->created_at)).'
								</span>
						</div>';
			}
		} else {
			echo '<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
							<div class="m-stack__item m-stack__item--center m-stack__item--middle">
								<span class="">
									Okunmamış Sistem Bildirimi Yok!
								</span>
							</div>
						</div>';
		}

	}

	public static function notificationCount() {
		$post = Post::select('status')->where('status','=',0)->count();

		return $post;
	}

	public static function getPost($slug) {
		$post = Post::select('*','posts.id as post_id')
			->leftJoin('term_relationships','posts.id','=','term_relationships.object_id')
			->leftJoin('terms','term_relationships.term_taxonomy_id','=','terms.id')
			->where('terms.slug','=',$slug)
			->where('posts.status','=',1)
			->groupBy('posts.id')
			->get();

		return $post;
	}

	public static function getFileLink($setting) {
		$image = Image::where('setting','=',$setting)->first();
		if(!empty($image)) {
			return asset('/images/user_upload/'.$image->filename);
		} else {
			return route('notfound');
		}
	}

	public static function getTerms($postId='',$select='') {

		if($postId == '') {
			return Terms::leftJoin('term_relationships','terms.id','=','term_taxonomy_id')
				->leftJoin('term_taxonomy','terms.id','=','term_taxonomy.term_id')
				->where('taxonomy','=','category')
				->groupBy('terms.id')
				->get();
		}

		if($select == 1) {
			return Terms::leftJoin('term_relationships','terms.id','=','term_taxonomy_id')
				->leftJoin('term_taxonomy','terms.id','=','term_taxonomy.term_id')
				->where('object_id','=',$postId)
				->where('taxonomy','=','category')
				->groupBy('terms.id')
				->get();
		} else if($select == 2) {
			return Terms::leftJoin('term_relationships','terms.id','=','term_taxonomy_id')
				->leftJoin('term_taxonomy','terms.id','=','term_taxonomy.term_id')
				->where('object_id','=',$postId)
				->where('taxonomy','=','etiket')
				->groupBy('terms.id')
				->get();
		}

	}

	public static function getCarBrandName($id) {
		return CarBrand::where('brand_code','=',$id)->first()->brand_type;
	}

	public static function getCarModelName($id) {
		return CarModel::where('id','=',$id)->first()->type_name;
	}

	public static function getCarModelYear($harf) {
		switch($harf) {
			case 'a':
				return '2004';
				break;
			case 'b':
				return '2005';
				break;
			case 'c':
				return '2006';
				break;
			case 'd':
				return '2007';
				break;
			case 'e':
				return '2008';
				break;
			case 'f':
				return '2009';
				break;
			case 'g':
				return '2010';
				break;
			case 'h':
				return '2011';
				break;
			case 'i':
				return '2012';
				break;
			case 'j':
				return '2013';
				break;
			case 'k':
				return '2014';
				break;
			case 'l':
				return '2015';
				break;
			case 'm':
				return '2016';
				break;
			case 'n':
				return '2017';
				break;
			case 'o':
				return '2018';
				break;
			case 'p':
				return '2019';
				break;
			case 'q':
				return '2020';
				break;
			case 'r':
				return '2021';
				break;
			case 's':
				return '2022';
				break;
			default:
				return '';
				break;
		}

	}

	public static function getCity($cityId) {
		return City::select('city_name')->where('id','=',$cityId)->first()->city_name;
	}

	public static function getPolicy() {
		if(!empty(Auth::user()->id)) {

			$policy = Policy::select('*','policy.id as policy_id','policy.status as policy_status')->leftJoin('user_cars','user_cars.user_id','=','policy.user_id')
				->where('policy.user_id','=',Auth::user()->id)->where('policy.cancel','=',0)->get();
			if($policy->first()) {
				foreach ($policy as $p) {
					echo "$('.clocktop" . $p->policy_id . "').countdown('" . date('m/d/Y', strtotime($p->request_finish)) . " " . date('H:i', $p->created_at) . "')
					.on('update.countdown', function(event) {
						var format = '%H:%M:%S';
						if(event.offset.totalDays > 0) {
							format = '%-d gün ' + format;
						}
						if(event.offset.weeks > 0) {
							format = '%-w hafta ' + format;
						}
						$(this).html(event.strftime(format));
					})
					.on('finish.countdown', function(event) {
						$(this).html('This offer has expired!')
							.parent().addClass('disabled');
					});";
				}
				return true;
			}
			return false;
		}

	}

	public static function getPolicyId() {
		$policy = Policy::select('policy.id as policy_id','policy.status as policy_status','user_cars.user_id','policy.user_id','policy.cancel')->leftJoin('user_cars','user_cars.user_id','=','policy.user_id')
			->where('policy.user_id','=',Auth::user()->id)->where('policy.cancel','=',0)->get();
		foreach($policy as $p) {
			echo '<span class="clocktop'.$p->policy_id.'"></span>';
		}

	}

	public static function activePolicy() {
		return Policy::select('policy.id as policy_id','policy.status as policy_status','user_cars.user_id','policy.user_id','policy.cancel')->leftJoin('user_cars','user_cars.user_id','=','policy.user_id')
			->where('policy.user_id','=',Auth::user()->id)->where('policy.cancel','=',0)->count();
	}

	public static function avaibleRemainder() {
		return UserPocketRelationships::where('user_id','=',Auth::user()->id)->sum('avaible_remainder');

	}

	public static function useRemainder() {
		return UserPocketRelationships::where('user_id','=',Auth::user()->id)->sum('use_remainder');

	}

}