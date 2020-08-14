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

    // Save negotiation.
    $router->post('save-negotiation', ['uses' => 'NegotiationController@saveNegotiation']);

    // Update negotiation process.
    $router->put('change-negotiation-list/{id}', ['uses' => 'NegotiationController@updateList']);
    
    // Toggle negotiation activation.
    $router->post('toggle-active-negotiation', ['uses' => 'NegotiationController@toggleActiveNegotiation']);
    
        // Update negotiation process.
        $router->put('change-negotiation-status/{id}', ['uses' => 'NegotiationController@updateStatus']);
    
    // Update todos.
    // $router->post('update-todos', ['uses' => 'TodoController@updateTodos']);
});

$router->group(['prefix' => 'widget','middleware' => 'auth:api'], function() use ($router) {
// Route::group(['prefix' => 'widget'], function () {
    $router->post('generateWidget',['uses'=>'WidgetController@store']);
});

Route::post('/apps', 'AppsController@store');
Route::post('widget', 'WidgetController@store');
Route::post('widget/data', 'WidgetDataController@store');