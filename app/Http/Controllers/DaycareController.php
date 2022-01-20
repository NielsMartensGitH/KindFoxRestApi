<?php

namespace App\Http\Controllers;

use App\Daycare;
use Illuminate\Http\Request;

class DaycareController extends Controller
{
    
    public function showDaycare()
    {
        return response()->json(Daycare::all());
    }

}