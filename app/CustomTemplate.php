<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomTemplate extends Model
{
    // Support AE template rotations
    const SUPPORTED_ROTAIONS = ["square", "portrait", "landscape"];
    // Rotation default resolution
    const DEFAULT_LANDSCAPE_RESOLUTION = "1920x1080";

    // Default templates path
    const DEFAULT_TEMPLATES_PATH = "file:///c:/Users/VA_V12/Desktop/templates/";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "templates";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rotation',
        'preview_url',
        'thumbnail_url'
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