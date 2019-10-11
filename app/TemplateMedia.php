<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateMedia extends Model
{ 
    const DEFAULT_TYPE = "image";
    const ALLOWED_TYPES = ["image", "text"];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "VA_Template_medias";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'placeholder',
        'type',
        'color',
        'default_value',
        'preview_path',
        'thumbnail_path'
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

    /**
     * Retrive parent template
     *
     * @return BelongsTo
     */
    public function template() : BelongsTo
    {
        return $this->belongTo(CustomTemplate::class);
    }
}