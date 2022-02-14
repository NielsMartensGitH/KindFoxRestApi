<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(['prefix' => 'api'], function () use ($router) {

  // =================== ENDPOINTS FOR DAYCARES ====================


  //  SHOWS ALL INFORMATION OF EVERY DAYCARE
  $router->get('daycares',  ['uses' => 'DaycareController@showDaycares']);

  // SHOWS ONLY THE INFORMATION OF ONE DAYCARE
  $router->get('daycares/{id}', ['uses' => 'DaycareController@showOneDayCare']);

     // SHOWS ONLY THE NAME OF A SPECIFIC DAYCARE
  $router->get('daycarename/{id}', ['uses' => 'DaycareController@getDaycareName']);

    // CREATES A NEW DAYCARE AFTER REGISTRATION
  $router->post("daycares", ['uses' => 'DaycareController@NewDaycare']);

  // ===================  ENDPOINTS FOR SHOWING PARENTS OF CHILDREN =============

  // SHOWS ALL CHILDREN OF A SPECIFIC PARENT
  $router->get('children/{parent_id}', ['uses' => 'DaycareController@showChildParent']);

  
  // ======================= ENDPOINTS FOR POSTS ====================== 


  // SHOWS ALL POSTS WITH DAYCARE INFO ADDED TO EACH POST
  $router->get('posts', ['uses' => 'DaycareController@showAllPosts']);

  // SHOWS ONLY A SINGLE POST BY ID
  $router->get('posts/{id}', ['uses' => 'DaycareController@showOnePost']);

   // SHOWS ONLY THE POSTS THAT ARE WRITTEN BY A SPECIFIC DAYCARE  
  $router->get('daycareposts/{id}', ['uses' => 'DaycareController@showDaycarePosts']);

   // SHOWS EVERY POSTS OF A SPECIFIC CHILD (private posts that only specific parent can see) AND A SPECIFIC DAYCARE (public posts)7
  $router->get('posts/{daycare_id}/{child_id}', ['uses' => 'DaycareController@showPosts']);

  // SHOWS IMAGES THAT ARE ATTACHED TO A POST
  $router->get('images/{id}', ['uses' => 'DaycareController@showImagesPerPost']);

  // ADDS A POST 
  $router->post('posts', ['uses' => 'DaycareController@addPost']);

   // DELETES A POST
  $router->delete('posts/{id}', ['uses' => 'DaycareController@deletePost']);

   // EDITS A POST
  $router->put('posts/{id}', ['uses' => 'DaycareController@editPost']);

   // SHOWS EVERY POSTS OF A SPECIFIC CHILD (private posts that only specific parent can see) AND A SPECIFIC DAYCARE (public posts)
  $router->get('posts/search/{daycare_id}/{child_id}', ['uses' => 'DaycareController@getPosts']);

  
  // =================== ENDPOINTS FOR POSTCOMMENTS ===================


  // SHOWS ALL THE COMMENTS OF A SPECIFIC POSTS INCLUDING THE PARENTS AND DAYCARE COMMENTS
  $router->get('comments/{id}', ['uses' => 'DaycareController@getCommentsByPost']);

  // ADD A COMMENT
  $router->post('comments', ['uses' => 'DaycareController@postComment']);

  // DELETE A COMMENT
  $router->delete('comments/{id}', ['uses' => 'DaycareController@deleteComment']);

  // EDIT A COMMENT
  $router->put('comments/{id}', ['uses' => 'DaycareController@editComment']);
  
  
  // ================= ENDPOINTS FOR PARENTS ========================


  // SHOWS EVERY PARENT
  $router->get('parents', ['uses' => 'DaycareController@showAllParents']);

   // ADDS A PARENT
  $router->post('parents', ['uses' => 'DaycareController@addParent']);
  
       // DELETES A PARENT
  $router->delete('parents/{id}', ['uses' => 'DaycareController@deleteParent']);

  // SHOWS ONLY ONE SPECIFIC PARENT
  $router->get('parents/{id}', ['uses' => 'DaycareController@showOneParent']);

  // UPDATES A SPECIFIC PARENT
  $router->put('/parents/{parent_id}', ['uses' => 'DaycareController@updateParent']);

  // GETS EVERY POSTS A PARENT MAY SEE INCLUDES THE POSTS OF THEIR CHILD AND THE POSTS THAT ARE PUBLIC FOR EVERY DAYCARE PARENT
  $router->get('parentposts/{parent_id}/{daycare_id}', ['uses' => 'DaycareController@getPostsByParent']);


  // ============================ ENDPOINTS FOR CHILDREN ==========================


  // SHOW ALL THE CHILDREN FROM EVERY DAYCARE
  $router->get('children', ['uses' => 'DaycareController@showChildren']);

  // ADDS A CHILD
  $router->post('children', ['uses' => 'DaycareController@addChild']);

  // GET A SPECIFIC CHILD BY THEIR ID
  $router->get('children/child/{child_id}', ['uses' => 'DaycareController@getChildById']);

  // GET ALL THE CHILDREN OF A SPECIFIC DAYCARE
  $router->get('daycarechildren/{daycare_id}', ['uses' => 'DaycareController@getChildrenFromDaycare']);

  // EDITS A CHILD
  $router->put('/children/edit/{id}', ['uses' => 'DaycareController@editChild']);

  // DELETE A CHILD
  $router->delete('children/{id}', ['uses' => 'DaycareController@deleteChild']);

  // TOGGLE CHILD CHECKED IN/CHECKED OUT
  $router->put('/children/{child_id}', ['uses' => 'DaycareController@updateChildCheckIn']);


  // ========================= ENDPOINTS FOR DIARIES ========================


  // SHOWS ALL THE DIARIES
  $router->get('diaries', ['uses' => 'DaycareController@showAllDiaries']);
  
  // DELETES A DIARY
  $router->delete('diaries/{id}', ['uses' => 'DaycareController@deleteDiary']);

  // ADDS A DIARY
  $router->post('diaries', ['uses' => 'DaycareController@addDiary']);

  // GET DIARY BY CHILD ID

  $router->get('diaries/{child_id}', ['uses' => 'DaycareController@showChildDiary']);

  // ============================ ENDPOINTS FOR DIARY COMMENTS =============================


  // GET EVERY COMMENT BY A SPECIFIC DIARY
  $router->get('diarycomments/{id}', ['uses' => 'DaycareController@getCommentsByDiary']);
  
  // DELETE A DIARY COMMENT
  $router->delete('diarycomments/{id}', ['uses' => 'DaycareController@deleteDiaryComment']);

   // EDIT A DIARY COMMENT
  $router->put('diarycomments/{id}', ['uses' => 'DaycareController@editDiaryComment']);

  // POSTS A DIARY COMMENT
  $router->post('diarycomments', ['uses' => 'DaycareController@postDiaryComment']);


  // ===================== ENDPOINTS FOR CALENDAR EVENTS ======================

    // SHOW EVERY EVENT
  $router->get('events', ['uses' => 'DaycareController@showEvents']);

  // ADD AN EVENT
  $router->post('events', ['uses' => 'DaycareController@addEvent']);

  // GET ALL THE EVENTS OF A SPECIFIC DAYCARE
  $router->get('events/{daycare_id}', ['uses' => 'DaycareController@getEventsByDaycareId']);


  // ========================= AUTHORIZATION ENDPOINTS =======================


  // FOR PARENTS LOGIN
  $router->get('parents/search/{email}', ['uses' => 'DaycareController@searchlogP']);

  // FOR DAYCARES LOGIN
  $router->get('daycares/search/{email}', ['uses' => 'DaycareController@searchlogDC']);

// ============================= IMAGE ENDPOINTS =================================================================

  // POST IMAGE NAMES

  $router->posts('images', ['uses' => 'DaycareController@postImageName']);

});