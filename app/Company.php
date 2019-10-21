<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   public $timestamps = false;
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['name'];
   
   public function types()
   {
       return $this->hasMany('App\Type');
   }
   
}
