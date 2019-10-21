<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cardNumber'];
    public function type()
    {
        return $this->belongsToMany('App\Type');
    }

}
