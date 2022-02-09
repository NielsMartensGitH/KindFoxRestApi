<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'type_id', 'child_id', 'message', 'daycare_id', 'privacy'         
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}