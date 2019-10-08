<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTemplate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "custom_templates";

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

    /**
     * Retrive render jobs
     *
     * @return App\RenderJob
     */
    public function jobs()
    {
        return $this->hasMany(RenderJob::class);
    }

    /**
     * Retrive template medias
     *
     * @return App\TemplateMedia
     */
    public function medias()
    {
        return $this->hasMany(TemplateMedia::class);
    }
}