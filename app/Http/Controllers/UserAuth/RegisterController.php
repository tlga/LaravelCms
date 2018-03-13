<?php

namespace App\Http\Controllers\UserAuth;

use App\City;
use App\Logic\Functions\Functions;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Response;
use Session;
use File;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/kullanici/telefon-dogrulama';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        if($data['select'] == 2) {
            return  Validator::make($data, [
              'name' => 'required|max:255',
              'email' => 'required|email|max:255|unique:users',
              'password' => 'required|min:6|confirmed',
              'phone' => 'required',
              'city' => 'required',
              'population' => 'required',
              'address' => 'required',
              'unvan' => 'required',
              'vergi' => 'required',
              'vergino' => 'required',
              'vergilevhasi' => 'required|max:2048|mimes:jpg,jpeg,bmp,png,pdf',
              'firmatemsilcisitc' => 'required|max:2048|mimes:jpg,jpeg,bmp,png,pdf',
            ], [
              'name.required' => 'Ad soyad alanını doldurmak zorundasınız!',
              'name.max' => 'Ad soyad alanı en fazla 255 karakter olabilir!',
              'email.required' => 'Email alanını doldurmak zorundasınız!',
              'email.email' => 'Email formatı geçersiz!',
              'email.max' => 'Email maksimum 255 karakter olabilir!',
              'email.unique' => 'Email adresi daha önceden kayıt edilmiş!',
              'password.required' => 'Parola alanını doldurmak zorundasınız!',
              'password.min' => 'Parola en az 6 karakter olmalıdır!',
              'password.confirmed' => 'Girdiğiniz parolalar uyuşmuyor!',
              'phone.required' => 'Telefon alanını girmek durumundasınız!',
              'city.required' => 'İkametgah ilinizi belirtmek durumundasınız!',
              'population.required' => 'T.C. kimlik no alanını doldurmak durumundasınız!',
              'address.required' => 'Adres bilginizi vermek zorundasınız!',
              'unvan.required' => 'Yasal şirket ünvanınızı belirtmek zorundasınız!',
              'vergi.required' => 'Vergi dairenizi belirtmek zorundasınız!',
              'vergino.required' => 'Vergi numaranızı belirtmek zorundasınız!',
              'vergilevhasi.required' => 'Vergi levhanızı göndermek zorundasınız!',
              'vergilevhasi.max' => 'Dosyanız maksimum 2mb büyüklüğünde olabilir!',
              'vergilevhasi.mimes' => 'Kabul edilen formatlar jpg,jpeg,bmp,png,pdf',
              'firmatemsilcisitc.required' => 'Firma temsilcisinin T.C. Kimlik cüzdanı fotokopisini göndermek zorundasınız!',
              'firmatemsilcisitc.max' => 'Dosyanız maksimum 2mb büyüklüğünde olabilir!',
              'firmatemsilcisitc.mimes' => 'Kabul edilen formatlar jpg,jpeg,bmp,png,pdf',
            ]);
        } else {
            return  Validator::make($data, [
              'name' => 'required|max:255',
              'email' => 'required|email|max:255|unique:users',
              'password' => 'required|min:6|confirmed',
              'phone' => 'required',
              'city' => 'required',
              'population' => 'required',
              'address' => 'required',
            ], [
              'name.required' => 'Ad soyad alanını doldurmak zorundasınız!',
              'name.max' => 'Ad soyad alanı en fazla 255 karakter olabilir!',
              'email.required' => 'Email alanını doldurmak zorundasınız!',
              'email.email' => 'Email formatı geçersiz!',
              'email.max' => 'Email maksimum 255 karakter olabilir!',
              'email.unique' => 'Email adresi daha önceden kayıt edilmiş!',
              'password.required' => 'Parola alanını doldurmak zorundasınız!',
              'password.min' => 'Parola en az 6 karakter olmalıdır!',
              'password.confirmed' => 'Girdiğiniz parolalar uyuşmuyor!',
              'phone.required' => 'Telefon alanını girmek durumundasınız!',
              'city.required' => 'İkametgah ilinizi belirtmek durumundasınız!',
              'population.required' => 'T.C. kimlik no alanını doldurmak durumundasınız!',
              'address.required' => 'Adres bilginizi vermek zorundasınız!',
            ]);
        }

    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $code = substr(str_shuffle("1234567890"),0,6);
        $phoneCode = $data['phone'][0];
        if ($phoneCode == 9) {
            $phone = $data['phone'];
        } else if($phoneCode == 0) {
            $phone = '9'.$data['phone'];
        } else if($phoneCode == 5){
            $phone = '90'.$data['phone'];
        } else {
            $phone = $data['phone'];
        }
        $xmlData='<?xml version="1.0" encoding="UTF-8"?>
                <mainbody>
                  <header>
                    <company>MYKASK</company>
                        <usercode>08508400008</usercode>
                        <password>ergun1984</password>
                    <startdate></startdate>
                    <stopdate></stopdate>
                      <type>1:n</type>
                        <msgheader>08508400008</msgheader>
                        </header>
                    <body>
                    <msg><![CDATA['.$code.' SMS sifresini kullanarak MyKask paneline giris yapabilirsiniz. Güvenliginiz icin sifrenizi kimseyle paylasmayin!]]></msg>
                    <no>'.$phone.'</no>
                    </body>
                </mainbody>';

        session()->put('code',$code);

        /*$url = 'http://api.netgsm.com.tr/xmlbulkhttppost.asp';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        //vcurl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        $result = curl_exec($ch);
        echo $result;*/




        if($data['select'] == 1) {
            return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'phone' => $phone,
              'city' => $data['city'],
              'population' => $data['population'],
              'address' => $data['address'],
            ]);
        } else {
            $path = public_path().'/images/user_archive/' . Functions::permalink($data['name']);
            File::makeDirectory($path, $mode = 0777, true, true);

            $file1 = @$data['vergilevhasi'];
            $fileName1 = Functions::permalink($file1->getClientOriginalName());
            $file1->move($path,$fileName1);

            $file2 = @$data['firmatemsilcisitc'];
            $fileName2 = Functions::permalink($file2->getClientOriginalName());
            $file2->move($path,$fileName2);

            return User::create([
              'name' => $data['name'],
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'phone' => $phone,
              'city' => $data['city'],
              'population' => $data['population'],
              'address' => $data['address'],
              'customer_type' => $data['select'],
              'sirket_unvani' => $data['unvan'],
              'vergi_dairesi' => $data['vergi'],
              'vergi_numarasi' => $data['vergino'],
              'vergi_levhasi' => $fileName1,
              'firma_temsilcisi_tc' => $fileName2,
            ]);
        }


    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $city = City::all();

        return view('user.auth.register', array(
          'title'            => 'Üyelik',
          'city'             => $city,
        ));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}
