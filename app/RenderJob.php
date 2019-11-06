<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RenderJob extends Model
{
    const DEFAULT_STATUS = "created";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "VA_Render_jobs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'message',
        'output_name',
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
        'user_id'       => 'integer',
        'progress'      => 'integer',
        'left_seconds'  => 'integer',
        'finished_at'   => 'datetime',
    ];

    /**
     * Retrive parent object
     *
     * @return BelongsTo
     */
    public function template() : BelongsTo
    {
        return $this->belongsTo(CustomTemplate::class);
    }
}
