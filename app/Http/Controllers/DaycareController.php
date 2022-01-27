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

    public function showAllPosts()
    {
        $result = DB::select("SELECT * FROM posts");
        return json_encode($result);
    }

    public function showPosts($daycare_id, $child_id)
    {
        $result = DB::select("SELECT * FROM posts 
        WHERE posts.daycare_id = $daycare_id 
        AND (posts.child_id = $child_id OR posts.child_id = 0)"); // bij meerdere kinderen ???
        return json_encode($result);
    }

    public function showChildParent($id)
    {
        $result = DB::select("SELECT * FROM children_parents 
        JOIN children 
        ON children.id = children_parents.child_id
        JOIN parents
        ON parents.id = children_parents.parenT_id
        WHERE parents.id = $id" );
        return json_encode($result);
    }
}