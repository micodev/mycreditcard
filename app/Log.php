<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps =false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["user_id","amount","label","date"];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
