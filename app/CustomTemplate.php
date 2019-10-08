<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTemplate extends Model
{
    /**
     * Set separated db connection
     *
     * @var string
     */
    protected $connection = "mysql_va";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'package',
        'version',
        'rotation',
        'preview_path'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'vau_id'   => 'integer',
    ];
}