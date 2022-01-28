<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildrenParents extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'child_id', 'parent_id' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}