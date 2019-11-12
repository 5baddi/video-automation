<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RenderJobMedia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "render_job_medias";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'render_job_id' => 'integer',
        'media_id'      => 'integer',
    ];

    /**
     * Retrive parent object
     *
     * @return BelongsTo
     */
    public function media() : BelongsTo
    {
        return $this->belongsTo(TemplateMedia::class);
    }

    /**
     * Retrive parent object
     *
     * @return BelongsTo
     */
    public function renderJob() : BelongsTo
    {
        return $this->belongsTo(RenderJob::class);
    }
}
