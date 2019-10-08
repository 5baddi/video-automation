<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
