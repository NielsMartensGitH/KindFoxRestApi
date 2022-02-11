<?php

namespace App\Http\Controllers;

use App\Daycare;
use App\Posts;
use App\Parents;
use App\Childrens;
use App\Comments;
use App\Diaries;
use App\Event;
use App\Diarycomments;
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
        posts.message,
        posts.privacy,
        daycares.name as daycarename,
        daycares.avatar as daycareavatar
        FROM posts
        JOIN daycares
        ON daycares.id =  posts.daycare_id ORDER BY posts.created_at DESC");
        return json_encode($result);
    }


    public function showAllDiaries()
    {
        $result = DB::select("SELECT
        diaries.id,
        diaries.type_id,
        diaries.created_at,
        diaries.child_id,
        diaries.food,
        diaries.foodSmile,
        diaries.sleep,
        diaries.sleepSmile,
        diaries.poop,
        diaries.mood,
        diaries.activities,
        diaries.involvement,
        diaries.extra_message,
        diaries.privacy,
        childrens.child_firstname as child_firstname,
        childrens.child_lastname as child_lastname,
        daycares.name as daycarename,
        daycares.avatar as daycareavatar
        FROM diaries
        JOIN daycares
        ON daycares.id =  diaries.daycare_id
        JOIN childrens
        ON childrens.id = diaries.child_id
        ORDER BY diaries.created_at DESC");
        return json_encode($result);
    }

    public function addDiary(Request $request)
    {
        $diary = Diaries::create($request->all());

        return response()->json($diary, 201);
    }

    public function deleteDiary($id)
    {
        Diaries::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);
    }

    public function getCommentsByDiary($id)
    {
        $result = DB::select("SELECT * FROM diarycomments WHERE diarycomments.diary_id = $id");
        return json_encode($result);
    }

    public function deleteDiaryComment($id)
    {
        Diarycomments::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);
    }

    public function editDiaryComment($id, Request $request)
    {
        $comment = Diarycomments::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    public function postDiaryComment(Request $request)
    {
        $comment = Diarycomments::create($request->all());
        return response()->json($comment, 201); 
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

    public function showDaycarePosts($id)
    {
        $result = DB::select("SELECT
        posts.id,
        posts.type_id,
        posts.created_at,
        posts.child_id,
        posts.message,
        posts.privacy,
        daycares.name as daycarename,
        daycares.avatar as daycareavatar
        FROM posts
        JOIN daycares
        ON daycares.id =  posts.daycare_id 
        WHERE posts.daycare_id = $id
        ORDER BY posts.created_at DESC");
        return json_encode($result);
    }

    public function showImagesPerPost($id)
    {
        $result = DB::select("SELECT posts.id, posts.message, images.id, images.imagepath 
        FROM posts 
        JOIN images 
        ON posts.image_id = images.id 
        WHERE posts.id = $id");
        return json_encode($result);
    }

    public function getDaycareName($id)
    {
        $result = DB::select("SELECT daycares.name FROM daycares WHERE daycares.id = $id");
        return json_encode($result);
    }


    public function showChildParent($parent_id)
    {
        $result = DB::select("SELECT * FROM childrens
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

     public function editPost($id, Request $request)
     {
        $post = Posts::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
     }

     public function getCommentsByPost($id)
     {
        $result = DB::select("SELECT
        comments.id,
        comments.created_at,
        comments.comment,
        comments.post_id,
        comments.parent_id,
        comments.daycare_id,
        parents.firstname,
        parents.lastname,
        parents.avatar as parentavatar, 
        daycares.name,
        daycares.avatar
        FROM comments
        LEFT JOIN parents ON parents.id = comments.parent_id
        LEFT JOIN daycares ON daycares.id = comments.daycare_id 
        WHERE comments.post_id = $id");
        return json_encode($result);
     }

     public function postComment(Request $request)
     {
        $comment = Comments::create($request->all());

        return response()->json($comment, 201);
     }

     public function deleteComment($id)
     {
        Comments::findOrFail($id)->delete();
        return response('Deleted succesfully', 200); 
     }

     public function editComment($id, Request $request)
     {
        $comment = Comments::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
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

    // public function updateChildCheckIn($child_id, Request $request)
    // {
    //     $child = Childrens::findOrFail($child_id);
    //     $child->update($request->all());
    //     return response()->json($child, 200);
    // }


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

    public function deleteChild($id)
     {
        Childrens::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }
     public function searchlogDC($email){
         $results = DB::select(
             "SELECT * FROM daycares WHERE email = '{$email}'"
         );
         return json_encode($results);
     }

     public function showEvents()
    {
        $result = DB::select("SELECT * FROM events");
        return json_encode($result);
    }

    public function addEvent(Request $request)
    {
        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function getPosts($child_id, $daycare_id){
        $result = DB::select("SELECT * FROM posts WHERE daycare_id = $daycare_id AND (child_id = $child_id OR privacy = 0)");

        return json_encode($result);
    }

    public function updateChildCheckIn($child_id, Request $request)
    {
        $child = Childrens::findOrFail($child_id);
        $child->update($request->all());
        return response()->json($child, 200);
    }

    public function getEventsByDaycareId($daycare_id)
    {
        $result = DB::select("SELECT *
        FROM events
        WHERE events.daycare_id = $daycare_id");
        return json_encode($result);     
    }

    public function getPostsByParent($parent_id, $daycare_id)
    {
        $result = DB::select("SELECT 
        posts.id,
        posts.created_at,
        posts.type_id,
        posts.child_id,
        posts.message,
        posts.image_id,
        posts.daycare_id,
        posts.privacy,
        childrenparents.parent_id,
        daycares.avatar,
        daycares.name
        FROM posts LEFT JOIN childrenparents ON posts.child_id = childrenparents.child_id
        JOIN daycares ON daycares.id =  posts.daycare_id
        WHERE (parent_id = $parent_id OR parent_id IS NULL) AND daycare_id = $daycare_id
        ORDER BY posts.created_at DESC");

        return json_encode($result);     
    }
}