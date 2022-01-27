<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'child_firstname', 'child_lastname', 'age', 'childcode'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}