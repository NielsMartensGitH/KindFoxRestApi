<?php

namespace App\Http\Controllers;

use App\Daycare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaycareController extends Controller
{
    
    public function showDaycares()
    {
        return response()->json(Daycare::all());
    }

    public function showOneDayCare($id)
    {
        $result = DB::select("SELECT * FROM daycares WHERE daycares.id = $id");
        return json_encode($result);
    }

    public function showParentPosts($id)
    {
        $result = DB::select("SELECT * FROM posts WHERE posts.parent_id = $id OR posts.daycare_id = ");
        return json_encode($result);
    }

}