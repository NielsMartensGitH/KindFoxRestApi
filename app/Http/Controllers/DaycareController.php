<?php

namespace App\Http\Controllers;

// IMPORTS OF OUR MODELS

use App\Daycare;
use App\Posts;
use App\Parents;
use App\Childrens;
use App\Comments;
use App\Diaries;
use App\Event;
use App\Diarycomments;
use App\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaycareController extends Controller
{


// ===================  METHODS FOR DAYCARES =========================


        //  SHOWS ALL INFORMATION OF EVERY DAYCARE 

    public function showDaycares()
    {
        return response()->json(Daycare::all());

    }

        // SHOWS ONLY THE INFORMATION OF ONE DAYCARE

    public function showOneDayCare($id)
    {
        $result = DB::select("SELECT * FROM daycares WHERE daycares.id = $id");
        return json_encode($result);
    }

        // SHOWS ONLY THE NAME OF A SPECIFIC DAYCARE

    public function getDaycareName($id)
    {
        $result = DB::select("SELECT daycares.name FROM daycares WHERE daycares.id = $id");
        return json_encode($result);
    }

        // CREATES A NEW DAYCARE AFTER REGISTRATION

    public function NewDaycare(Request $request){
        $daycare = Daycare::create($request->all());
        return response()->json($daycare, 201);
    }


// ===================== METHODS FOR SHOXING PARENTS OF CHILDREN ====================


        // SHOWS ALL CHILDREN OF A SPECIFIC PARENT

    public function showChildParent($parent_id)
    {
        $result = DB::select("SELECT * FROM childrens
        WHERE childrens.parent_id = $parent_id" );
        return json_encode($result);
    }

        


//  ========================= METHODS FOR POSTS =============================


        // SHOWS ALL POSTS WITH DAYCARE INFO ADDED TO EACH POST

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

        // SHOWS ONLY A SINGLE POST BY ID

    public function showOnePost($id)
    {
        $result = DB::select("SELECT * FROM posts WHERE posts.id = $id");
        return json_encode($result);
    }

        // SHOWS ONLY THE POSTS THAT ARE WRITTEN BY A SPECIFIC DAYCARE

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

        // SHOWS EVERY POSTS OF A SPECIFIC CHILD (private posts that only specific parent can see) AND A SPECIFIC DAYCARE (public posts)

    public function showPosts($daycare_id, $child_id)
    {
        $result = DB::select("SELECT * FROM posts 
        WHERE posts.daycare_id = $daycare_id 
        AND (posts.child_id = $child_id OR posts.child_id = NULL)");
        return json_encode($result);
    }

        // SHOWS IMAGES THAT ARE ATTACHED TO A POST

    public function showImagesPerPost($id)
    {
        $result = DB::select("SELECT posts.id, posts.message, images.id, images.imagepath 
        FROM posts 
        JOIN images 
        ON posts.image_id = images.id 
        WHERE posts.id = $id");
        return json_encode($result);
    }

        // ADDS A POST 
    
    public function addPost(Request $request)
    {
        $post = Posts::create($request->all());

        return response()->json($post->id, 201);
    }

        // DELETES A POST

    public function deletePost($id)
     {
        Posts::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }

        // EDITS A POST

     public function editPost($id, Request $request)
     {
        $post = Posts::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
     }

         // SHOWS EVERY POSTS OF A SPECIFIC CHILD (private posts that only specific parent can see) AND A SPECIFIC DAYCARE (public posts)

     public function getPosts($child_id, $daycare_id){
        $result = DB::select("SELECT * FROM posts WHERE daycare_id = $daycare_id AND (child_id = $child_id OR privacy = 0)");

        return json_encode($result);
    }


// ===================== METHODS FOR POSTCOMMENTS ==============================


        // SHOWS ALL THE COMMENTS OF A SPECIFIC POSTS INCLUDING THE PARENTS AND DAYCARE COMMENTS

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

        // ADD A COMMENT

     public function postComment(Request $request)
     {
        $comment = Comments::create($request->all());

        return response()->json($comment, 201);
     }

        // DELETE A COMMENT

     public function deleteComment($id)
     {
        Comments::findOrFail($id)->delete();
        return response('Deleted succesfully', 200); 
     }

        // EDIT A COMMENT

     public function editComment($id, Request $request)
     {
        $comment = Comments::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
     }


// =========================  METHODS FOR PARENTS ==============================


        // SHOWS EVERY PARENT


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

     // GET ALL THE PARENTS OF A SPECIFIC DAYCARE

    public function getParentsByDaycareId($daycare_id)
    {
        $result = DB::select("SELECT * FROM parents WHERE parents.daycare_id = $daycare_id");
        return json_encode($result);
    }

        // ADDS A PARENT

     public function addParent(Request $request)
    {
        $parent = Parents::create($request->all());

        return response()->json($parent, 201);
    }

        // DELETES A PARENT

    public function deleteParent($id)
     {
        Parents::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }

        // SHOWS ONLY ONE SPECIFIC PARENT

     public function showOneParent($id)
     {
         $result = DB::select("SELECT * FROM parents WHERE parents.id = $id");
         return json_encode($result);
     }

        // UPDATES A SPECIFIC PARENT

     public function updateParent($parent_id, Request $request)
     {
         $parent = Parents::findOrFail($parent_id);
         $parent->update($request->all());
         return response()->json($parent, 200);
     }

        // GETS EVERY POSTS A PARENT MAY SEE INCLUDES THE POSTS OF THEIR CHILD AND THE POSTS THAT ARE PUBLIC FOR EVERY DAYCARE PARENT

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


// =======================  METHODS FOR CHILDREN ========================


        // SHOW ALL THE CHILDREN FROM EVERY DAYCARE

    public function showChildren()
    {
        $result = DB::select("SELECT * FROM childrens");
        return json_encode($result);
    }

        // ADDS A CHILD

    public function addChild(Request $request)
    {
        $child = Childrens::create($request->all());

        return response()->json($child->id, 201);
    }

     // PIVOT OF PARENTS AND CHILDREN

     public function pivotChildParent(Request $request)
     {
        DB::table('childrenparents')->insert([
            'child_id'=>$request->child_id,
            'parent_id'=>$request->parent_id
        ]);

        return response()->json(201);
     }    

        // GET A SPECIFIC CHILD BY THEIR ID

    public function getChildById($child_id)
    {
        $result = DB::select("SELECT *
        FROM childrens
        WHERE childrens.id = $child_id");
        return json_encode($result);     
    }

        // GET ALL THE CHILDREN OF A SPECIFIC DAYCARE

    public function getChildrenFromDaycare($daycare_id)
    {
        $result = DB::select("SELECT * FROM childrens WHERE childrens.daycare_id = $daycare_id");
        return json_encode($result);
    }

        // EDITS A CHILD

    public function editChild($id, Request $request)
     {
        $child = Childrens::findOrFail($id);
        $child->update($request->all());

        return response()->json($child, 200);
     }

        // DELETE A CHILD

     public function deleteChild($id)
     {
        Childrens::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);        
     }

        // TOGGLE CHILD CHECKED IN/CHECKED OUT

     public function updateChildCheckIn($child_id, Request $request)
     {
         $child = Childrens::findOrFail($child_id);
         $child->update($request->all());
         return response()->json($child, 200);
     }

      // public function updateChildCheckIn($child_id, Request $request)
    // {
    //     $child = Childrens::findOrFail($child_id);
    //     $child->update($request->all());
    //     return response()->json($child, 200);
    // }


// =======================  METHODS FOR DIARIES =========================


        // SHOWS ALL THE DIARIES
  
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

    // GET ALL THE DIARIES OF A SPECIFIC DAYCARE

    public function getDiariesByDaycareId($daycare_id)
    {
        $result = DB::select("SELECT *
        FROM diaries
        WHERE diaries.daycare_id = $daycare_id");
        return json_encode($result);     
    }

        // DELETES A DIARY

    public function deleteDiary($id)
    {
        Diaries::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);
    }

        // ADDS A DIARY

    public function addDiary(Request $request)
    {
        $diary = Diaries::create($request->all());

        return response()->json($diary, 201);
    }

        // GET DIARY OF SPECIFIC CHILDREN

        public function showChildDiary($child_id)
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
            WHERE diaries.child_id = $child_id
            ORDER BY diaries.created_at DESC");
            return json_encode($result);
        }  


// ====================== METHODS FOR DIARY COMMENTS ==========================


        // GET EVERY COMMENT BY A SPECIFIC DIARY

    public function getCommentsByDiary($id)
    {
        $result = DB::select("SELECT
        diarycomments.id,
        diarycomments.created_at,
        diarycomments.comment,
        diarycomments.diary_id,
        diarycomments.parent_id,
        diarycomments.daycare_id,
        parents.firstname,
        parents.lastname,
        parents.avatar as parentavatar, 
        daycares.name,
        daycares.avatar
        FROM diarycomments
        LEFT JOIN parents ON parents.id = diarycomments.parent_id
        LEFT JOIN daycares ON daycares.id = diarycomments.daycare_id 
        WHERE diarycomments.diary_id = $id");
        return json_encode($result);
        // $result = DB::select("SELECT * FROM diarycomments WHERE diarycomments.diary_id = $id");
        // return json_encode($result);
    }

        // DELETE A DIARY COMMENT

    public function deleteDiaryComment($id)
    {
        Diarycomments::findOrFail($id)->delete();
        return response('Deleted succesfully', 200);
    }

        // EDIT A DIARY COMMENT

    public function editDiaryComment($id, Request $request)
    {
        $comment = Diarycomments::findOrFail($id);
        $comment->update($request->all());

        return response()->json($comment, 200);
    }

        // POSTS A DIARY COMMENT

    public function postDiaryComment(Request $request)
    {
        $comment = Diarycomments::create($request->all());
        return response()->json($comment, 201); 
    }


// =====================  METHODS FOR CALENDAR EVENTS =============================


        // SHOW EVERY EVENT

    public function showEvents()
    {
        $result = DB::select("SELECT * FROM events");
        return json_encode($result);
    }

        // ADD AN EVENT

    public function addEvent(Request $request)
    {
        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

        // GET ALL THE EVENTS OF A SPECIFIC DAYCARE

    public function getEventsByDaycareId($daycare_id)
    {
        $result = DB::select("SELECT *
        FROM events
        WHERE events.daycare_id = $daycare_id");
        return json_encode($result);     
    }


// ========================= AUTHORIZATION METHODS =========================


        // FOR PARENTS LOGIN
   
    public function searchlogP($email){
        $results = DB::select(
            "SELECT * FROM parents WHERE email = '{$email}'
            ");
        return json_encode($results);
        
    }

        // FOR DAYCARES LOGIN

     public function searchlogDC($email){
         $results = DB::select(
             "SELECT * FROM daycares WHERE email = '{$email}'"
         );
         return json_encode($results);
     }

// ======================== IMAGE METHODS =========================    

     // POST IMAGE NAMES

     public function postImageName(Request $request)
    {
        $image = Images::create($request->all());
        return response()->json($image->id, 201);
     }

     public function createpivot(Request $request)
     {
        DB::table('posts_images')->insert([
            'post_id'=>$request->post_id,
            'image_id'=>$request->image_id
        ]);

        return response()->json(201);
     }

        public function getImagesByPost($post_id)
        {
            $result = DB::select("SELECT * FROM images WHERE images.post_id = $post_id");
            return json_encode($result);
        }

        public function getAllImages()
        {
            $result = DB::select("SELECT * FROM images");
            return json_encode($result); 
        }

    //  public function getImagesByPost($post_id)
    // {
    //     $result = DB::select("SELECT
    //     posts_images.post_id,
    //     images.imagepath
    //     FROM images
    //     JOIN posts_images
    //     ON images.id = posts_images.image_id
    //     WHERE posts_images.post_id = $post_id");
    //     return json_encode($result);
    // }
      
}