<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateMedia extends Model
{ 
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
        'default'
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
     * @return App\CustomTemplate
     */
    public function template()
    {
        return $this->belongTo(CustomTemplate::class);
    }
}