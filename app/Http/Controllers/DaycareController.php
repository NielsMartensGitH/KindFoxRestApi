<?php

namespace App\Http\Controllers;

use App\Daycare;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaycareController extends Controller
{
    
    public function showDaycares()
    {
        return response()->json(Daycare::all());

        // $result = DB::select("SELECT * FROM daycare");
        // return json_encode($result);
    }

    public function showOneDayCare($id)
    {
        $result = DB::select("SELECT * FROM daycares WHERE daycares.id = $id");
        return json_encode($result);
    }

    public function showAllPosts()
    {
        $result = DB::select("SELECT
        posts.id,
        posts.type_id,
        posts.created_at,
        posts.child_id,
        posts.picture,
        posts.message,
        posts.privacy,
        daycares.name as daycarename,
        daycares.avatar as daycareavatar
        FROM posts
        JOIN daycares
        ON daycares.id =  posts.daycare_id");
        return json_encode($result);
    }

    public function showPosts($daycare_id, $child_id)
    {
        $result = DB::select("SELECT * FROM posts 
        WHERE posts.daycare_id = $daycare_id 
        AND (posts.child_id = $child_id OR posts.child_id = NULL)");
        return json_encode($result);
    }

    public function showChildParent($id)
    {
        $result = DB::select("SELECT * FROM childrenparents 
        JOIN children 
        ON children.id = childrenparents.child_id
        JOIN parents
        ON parents.id = childrenparents.parenT_id
        WHERE parents.id = $id" );
        return json_encode($result);
    }

    public function deletePost($id)
     {
        Posts::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }
}