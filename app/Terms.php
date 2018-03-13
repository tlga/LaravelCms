<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{

    protected $table = 'terms';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    public static $rules = [
      'name' => 'required',
    ];
    public static $messages = [
      'name.required' => 'Ad alanı boş bırakılamaz.',
    ];

   
}
