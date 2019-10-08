<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateMedia extends Model
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
        'type',
        'color',
        'default'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'template_id'       => 'integer',
        'position'          => 'integer',
        'background_hue'    => 'smallInteger',
    ];
}