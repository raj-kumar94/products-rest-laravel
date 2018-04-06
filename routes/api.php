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


Route::middleware(['auth:api'])->group(function () {
    Route::post('add', ['as' => 'add', 'uses' => 'ProductsController@add']);
    Route::put('update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
    Route::delete('delete/{id}', ['as' => 'delete', 'uses' => 'ProductsController@delete']);
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'ProductsController@viewProduct']);
    Route::get('all', ['as' => 'all', 'uses' => 'ProductsController@listAll']);
    // Route::get('viewi/{id}', ['as' => 'viewi', 'uses' => 'ProductsController@viewImage']);    
});


Route::prefix('image')->group(function () {
    Route::post('add', ['as' => 'iadd', 'uses' => 'ImagesController@add']);
    Route::put('update/{id}', ['as' => 'iupdate', 'uses' => 'ImagesController@update']);
    Route::delete('delete/{id}', ['as' => 'idelete', 'uses' => 'ImagesController@delete']);
});