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

  // ==============ENDPOINTS FOR DAYCARES==============

  $router->get('daycares',  ['uses' => 'DaycareController@showDaycares']);

  $router->get('daycares/{id}', ['uses' => 'DaycareController@showOneDayCare']);

  $router->get('daycarename/{id}', ['uses' => 'DaycareController@getDaycareName']);

  $router->post("daycares", ['uses' => 'DaycareController@NewDaycare']);

  // ENDPOINTS FOR SHOWING PARENTS OF CHILDREN

  $router->get('children/{parent_id}', ['uses' => 'DaycareController@showChildParent']);

  // ENDPOINTS FOR POSTS 

  $router->get('posts', ['uses' => 'DaycareController@showAllPosts']);

  $router->get('posts/{id}', ['uses' => 'DaycareController@showOnePost']);

  $router->get('daycareposts/{id}', ['uses' => 'DaycareController@showDaycarePosts']);

  $router->get('posts/{daycare_id}/{child_id}', ['uses' => 'DaycareController@showPosts']);

  $router->get('images/{id}', ['uses' => 'DaycareController@showImagesPerPost']);

  $router->post('posts', ['uses' => 'DaycareController@addPost']);

  $router->delete('posts/{id}', ['uses' => 'DaycareController@deletePost']);

  $router->put('posts/{id}', ['uses' => 'DaycareController@editPost']);

  $router->get('posts/search/{daycare_id}/{child_id}', ['uses' => 'DaycareController@getPosts']);

  // ENDPOINTS FOR POSTCOMMENTS

  $router->get('comments/{id}', ['uses' => 'DaycareController@getCommentsByPost']);

  $router->post('comments', ['uses' => 'DaycareController@postComment']);

  $router->delete('comments/{id}', ['uses' => 'DaycareController@deleteComment']);

  $router->put('comments/{id}', ['uses' => 'DaycareController@editComment']);
  
  // ENDPOINTS FOR PARENTS

  $router->get('parents', ['uses' => 'DaycareController@showAllParents']);

  $router->post('parents', ['uses' => 'DaycareController@addParent']);
  
  $router->delete('parents/{id}', ['uses' => 'DaycareController@deleteParent']);

  $router->get('parents/{id}', ['uses' => 'DaycareController@showOneParent']);

  $router->put('/parents/{parent_id}', ['uses' => 'DaycareController@updateParent']);

  $router->get('parentposts/{parent_id}/{daycare_id}', ['uses' => 'DaycareController@getPostsByParent']);

  // ENDPOINTS FOR CHILDREN

  $router->get('children', ['uses' => 'DaycareController@showChildren']);

  $router->post('children', ['uses' => 'DaycareController@addChild']);

  $router->get('children/child/{child_id}', ['uses' => 'DaycareController@getChildById']);

  $router->get('daycarechildren/{daycare_id}', ['uses' => 'DaycareController@getChildrenFromDaycare']);

  $router->put('/children/edit/id}', ['uses' => 'DaycareController@editChild']);

  $router->delete('children/{id}', ['uses' => 'DaycareController@deleteChild']);

  $router->put('/children/{child_id}', ['uses' => 'DaycareController@updateChildCheckIn']);

  // ENDPOINTS FOR DIARIES

  $router->get('diaries', ['uses' => 'DaycareController@showAllDiaries']);
  
  $router->delete('diaries/{id}', ['uses' => 'DaycareController@deleteDiary']);

  $router->get('diarycomments/{id}', ['uses' => 'DaycareController@getCommentsByDiary']);
  
  $router->delete('diarycomments/{id}', ['uses' => 'DaycareController@deleteDiaryComment']);

  $router->put('diarycomments/{id}', ['uses' => 'DaycareController@editDiaryComment']);

  $router->post('diarycomments', ['uses' => 'DaycareController@postDiaryComment']);

  $router->post('diaries', ['uses' => 'DaycareController@addDiary']);

  $router->get('daycares/search/{email}', ['uses' => 'DaycareController@searchlogDC']);

  // ENDPOINTS FOR CALENDAR EVENTS

  $router->get('events', ['uses' => 'DaycareController@showEvents']);

  $router->post('events', ['uses' => 'DaycareController@addEvent']);

  $router->get('events/{daycare_id}', ['uses' => 'DaycareController@getEventsByDaycareId']);

  // OTHER ENDPOINTS
  
  $router->get('parents/search/{email}', ['uses' => 'DaycareController@searchlogP']);
});