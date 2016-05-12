<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'prefix' => 'api',
    'middleware' => 'auth:api'
], function () {
    /**
     * Task Routes...
     */
    Route::get('/teams/{team}/tasks', 'API\TaskController@all');
    Route::post('/teams/{team}/tasks', 'API\TaskController@store');
    Route::get('/teams/{team}/tasks/{task}', 'API\TaskController@show');
    Route::delete('/teams/{team}/tasks/{task}', 'API\TaskController@destroy');
});
