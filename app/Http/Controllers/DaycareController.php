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
        ON daycares.id =  posts.daycare_id ORDER BY posts.created_at DESC");
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

    public function addPost(Request $request)
    {
        $post = Posts::create($request->all());

        return response()->json($post, 201);
    }

    public function deletePost($id)
     {
        Posts::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }

     public function showAllParents()
    {
        $result = DB::select("SELECT
        parents.id,
        parents.firstname,
        parents.lastname,
        parents.login as email,
        parents.password,
        parents.daycare_id,
        parents.phone
        FROM parents");
        return json_encode($result);
    }

    public function addParent(Request $request)
    {
        $post = Parents::create($request->all());

        return response()->json($post, 201);
    }


}