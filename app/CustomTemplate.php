<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTemplate extends Model
{
    const ROTAIONS = ["square", "portrait", "landscape"];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "VA_Custom_templates";

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
        'preview_path',
        'thumbnail_path'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'vau_id'   => 'integer',
    ];

    /**
     * Retrive render jobs
     *
     * @return App\RenderJob
     */
    public function jobs()
    {
        return $this->hasMany(RenderJob::class, 'template_id');
    }

    /**
     * Retrive template medias
     *
     * @return App\TemplateMedia
     */
    public function medias()
    {
        return $this->hasMany(TemplateMedia::class, 'template_id');
    }
}