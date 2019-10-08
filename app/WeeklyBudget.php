<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyBudget extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'v_user_payment_weekly_budget';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
