<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daycare extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'amount', 'email', 'password', 'street', 'country', 'city', 'phone', 'postal_code', 'btw_number', 'capacity_per_employee', 'employee_amount', 'avatar'         
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}