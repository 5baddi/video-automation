<?php

namespace App\Entities\VAU;

class TemplateEntity
{
    /**
     * The template attributes
     *
     * @var App\Entities\VAU\TemplateAttributesEntity
     */
    public $attributes;

    /**
     * The template inputs
     *
     * @var array
     */
    public $inputs;

    /**
     * The output name
     *
     * @var string
     */
    public $name;
}