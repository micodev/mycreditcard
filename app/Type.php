<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["brandPrice","price","company_id"];
    
    public function card()
    {
        return $this->hasMany('App\Card');
    }
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
