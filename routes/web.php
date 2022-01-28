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

  $router->get('childparent/{id}', ['uses' => 'DaycareController@showChildParent']);

  $router->get('posts', ['uses' => 'DaycareController@showAllPosts']);

  $router->get('posts/{daycare_id}/{child_id}', ['uses' => 'DaycareController@showPosts']);

  $router->delete('posts/{id}', ['uses' => 'DaycareController@deletePost']);

  $router->post('authors', ['uses' => 'AuthorController@create']);

  $router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);


  $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
  
  $router->get('parents/{id}', ['uses' => 'DaycareController@showAllParents']);

});