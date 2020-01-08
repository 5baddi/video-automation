<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateMedia extends Model
{ 
    const ALLOWED_TYPES = ["image", "text", "color", "audio"];
    const SCENE_TYPE = self::ALLOWED_TYPES[0];
    const TEXT_TYPE = self::ALLOWED_TYPES[1];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "template_medias";

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
        'thumbnail_url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'template_id'       => 'integer',
        'scene'             => 'integer',
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