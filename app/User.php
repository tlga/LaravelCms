<?php

namespace App;

use App\Notifications\UserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Response;
class User extends Authenticatable
{
    public static $rules = [
      'name'       => 'required',
      'email'       => 'required',
      'password'  => 'required',
    ];
    public static $messages = [
      'name.required' => 'Marka alanını girmek zorundasınız!',
      'email.required' => 'Model alanını girmek zorundasınız!',
      'password.required' => 'Model yılı alanını girmek zorundasınız!',
    ];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'population', 'phone','city','address','customer_type','sirket_unvani','vergi_dairesi','vergi_numarasi','imza_sirkusu',
        'vergi_levhasi','firma_temsilcisi_tc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public static function profileUpdate($inputs) {


        if($inputs['password'] != '' && empty($inputs['password'])) {
            $password = self::where('id','=',Auth::user()->id)->first()->password;
        } else {
            $password = bcrypt($inputs['password']);
        }

        self::where('id','=',Auth::user()->id)->update(array(
          'name'            => $inputs['name'],
          'email'           => $inputs['email'],
          'password'        => $password,
          'population'      => $inputs['population'],
          'phone'           => $inputs['phone'],
          'city'            => $inputs['city'],
          'address'         => $inputs['address'],
          'updated_at'      => date('Y-m-d H:i:s', time()),
        ));

        return Response::json([
          'error'  => false,
          'code'  => 200,
          'msg'   => 'Tebrikler, profiliniz başarıyla güncellendi.'
        ]);
    }

    public static function profileDelete() {

        self::where('id','=',Auth::user()->id)->delete();

        return Response::json([
          'error'  => false,
          'code'  => 200,
          'msg'   => 'Hesabınız silindi :( Tekrar görüşmek üzere...'
        ]);
    }
}
