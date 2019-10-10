<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenderJob extends Model
{
    const DEFAULT_STATUS = "pending";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "va_render_jobs";

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
        'vau_job_id'    => 'integer',
        'progress'      => 'integer',
        'left_seconds'  => 'integer',
        'finished_at'   => 'datetime',
    ];

    /**
     * Retrive parent object
     *
     * @return App\CustomTemplate
     */
    public function template()
    {
        return $this->belongsTo(CustomTemplate::class);
    }
}