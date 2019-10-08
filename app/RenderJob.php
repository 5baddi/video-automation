<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenderJob extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "render_jobs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'message',
        'output_url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'template_id'   => 'integer',
        'job_id'        => 'integer',
        'progress'      => 'integer',
        'left'          => 'integer'
    ];
}