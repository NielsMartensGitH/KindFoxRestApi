<?php

namespace App\Http\Controllers;

use App\Daycare;
use App\Posts;
use App\Parents;
use App\Childrens;
use App\Comments;
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

    public function showChildren()
    {
        $result = DB::select("SELECT * FROM childrens");
        return json_encode($result);
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

    public function showOnePost($id)
    {
        $result = DB::select("SELECT * FROM posts WHERE posts.id = $id");
        return json_encode($result);
    }


    public function showChildParent($parent_id)
    {
        $result = DB::select("SELECT * FROM childrens
        JOIN parents 
        ON childrens.parent_id = parents.id
        WHERE childrens.parent_id = $parent_id" );
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

     public function getCommentsByPost($id)
     {
        $result = DB::select("SELECT * FROM comments WHERE comments.post_id = $id");
        return json_encode($result);
     }

     public function postComment(Request $request)
     {
        $comment = Comments::create($request->all());

        return response()->json($comment, 201);
     }

     public function showAllParents()
    {
        $result = DB::select("SELECT
        parents.id,
        parents.firstname,
        parents.lastname,
        parents.email,
        parents.password,
        parents.daycare_id,
        parents.phone
        FROM parents");
        return json_encode($result);
    }

    public function addParent(Request $request)
    {
        $parent = Parents::create($request->all());

        return response()->json($parent, 201);
    }

    public function deleteParent($id)
     {
        Parents::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }

     public function addChild(Request $request)
    {
        $child = Childrens::create($request->all());

        return response()->json($child, 201);
    }

    public function showOneParent($id)
    {
        $result = DB::select("SELECT * FROM parents WHERE parents.id = $id");
        return json_encode($result);
    }

    public function updateParent($parent_id, Request $request)
    {
        $parent = Parents::findOrFail($parent_id);
        $parent->update($request->all());
        return response()->json($parent, 200);
    }


    public function searchlogP($email){
        $results = DB::select(
            "SELECT * FROM parents WHERE email = '{$email}'
            ");
        return json_encode($results);
        
    }
    public function NewDaycare(Request $request){
        $daycare = Daycare::create($request->all());
        return response()->json($daycare, 201);
    }
}