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
  $router->get('daycares',  ['uses' => 'DaycareController@showDaycares']);

  $router->get('daycares/{id}', ['uses' => 'DaycareController@showOneDayCare']);

  $router->get('children/{parent_id}', ['uses' => 'DaycareController@showChildParent']);

  $router->get('posts', ['uses' => 'DaycareController@showAllPosts']);

  $router->get('posts/{id}', ['uses' => 'DaycareController@showOnePost']);

  $router->get('daycareposts/{id}', ['uses' => 'DaycareController@showDaycarePosts']);

  $router->get('posts/{daycare_id}/{child_id}', ['uses' => 'DaycareController@showPosts']);

  $router->get('images/{id}', ['uses' => 'DaycareController@showImagesPerPost']);

  $router->post('posts', ['uses' => 'DaycareController@addPost']);

  $router->delete('posts/{id}', ['uses' => 'DaycareController@deletePost']);

  $router->put('posts/{id}', ['uses' => 'DaycareController@editPost']);

  $router->get('comments/{id}', ['uses' => 'DaycareController@getCommentsByPost']);

  $router->post('comments', ['uses' => 'DaycareController@postComment']);

  $router->delete('comments/{id}', ['uses' => 'DaycareController@deleteComment']);

  $router->put('comments/{id}', ['uses' => 'DaycareController@editComment']);
  
  $router->get('parents', ['uses' => 'DaycareController@showAllParents']);

  $router->post('parents', ['uses' => 'DaycareController@addParent']);
  
  $router->delete('parents/{id}', ['uses' => 'DaycareController@deleteParent']);

  $router->get('children', ['uses' => 'DaycareController@showChildren']);

  $router->post('children', ['uses' => 'DaycareController@addChild']);

  $router->get('parents/{id}', ['uses' => 'DaycareController@showOneParent']);

  $router->put('/parents/{parent_id}', ['uses' => 'DaycareController@updateParent']);
  

  $router->get('parents/search/{email}', ['uses' => 'DaycareController@searchlogP']);

  $router->post("daycares", ['uses' => 'DaycareController@NewDaycare']);

  $router->delete('children/{id}', ['uses' => 'DaycareController@deleteChild']);

  $router->get('diaries', ['uses' => 'DaycareController@showAllDiaries']);
  
  $router->delete('diaries/{id}', ['uses' => 'DaycareController@deleteDiary']);

  $router->get('diarycomments/{id}', ['uses' => 'DaycareController@getCommentsByDiary']);
  
  $router->delete('diarycomments/{id}', ['uses' => 'DaycareController@deleteDiaryComment']);

  $router->put('diarycomments/{id}', ['uses' => 'DaycareController@editDiaryComment']);

  $router->post('diarycomments', ['uses' => 'DaycareController@postDiaryComment']);

  $router->post('diaries', ['uses' => 'DaycareController@addDiary']);

  $router->get('daycares/search/{email}', ['uses' => 'DaycareController@searchlogDC']);

  $router->get('events', ['uses' => 'DaycareController@showEvents']);

  $router->post('events', ['uses' => 'DaycareController@addEvent']);

  $router->get('posts/search/{daycare_id}/{child_id}', ['uses' => 'DaycareController@getPosts']);

  $router->put('/children/{child_id}', ['uses' => 'DaycareController@updateChildCheckIn']);

  $router->get('parentposts/{parent_id}/{daycare_id}', ['uses' => 'DaycareController@getPostsByParent']);

  $router->get('events/{daycare_id}', ['uses' => 'DaycareController@getEventsByDaycareId']);
  
});