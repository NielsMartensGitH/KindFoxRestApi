<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diaries extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'type_id', 'child_id', 'food', 'foodSmile', 'sleep', 'sleepSmile', 'poop', 'mood', 'activities','involvement', 'extra_message', 'privacy', 'daycare_id'    
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}