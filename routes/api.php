<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
    
// Todos routes
$router->group(['prefix' => 'todos'], function() use ($router) {

    // Save todo.
    $router->post('save-todo', ['uses' => 'TodoController@saveTodo']);

    // Update todos.
    $router->post('update-todos', ['uses' => 'TodoController@updateTodos']);
});
    
// Negotiations routes
$router->group(['prefix' => 'negotiations'], function() use ($router) {

    // Save todo.
    $router->post('save-negotiation', ['uses' => 'NegotiationController@saveNegotiation']);

    // Update todos.
    // $router->post('update-todos', ['uses' => 'TodoController@updateTodos']);
});