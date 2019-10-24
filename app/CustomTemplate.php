<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'preview_url',
        'thumbnail_url',
        'gif_url'
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
     * @return HasMany
     */
    public function jobs() : HasMany
    {
        return $this->hasMany(RenderJob::class, 'template_id');
    }

    /**
     * Retrive template medias
     *
     * @return HasMany
     */
    public function medias() : HasMany
    {
        return $this->hasMany(TemplateMedia::class, 'template_id');
    }

    /**
     * Delete also the relations
     *
     * @return bool|null|void
     */
    public function delete()
    {
        // Delete medias
        $this->medias()->delete();
        // Delete render jobs
        $this->jobs()->delete();

        return parent::delete();
    }
}