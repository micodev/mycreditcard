<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps =false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name","number","balance","username"];
    
    public function logs()
    {
        return $this->hasMany('App\Log');
    }
    
}
