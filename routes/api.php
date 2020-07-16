<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    'question' => 'QuestionController',
    'category' => 'CategoryController',
    'question/{question}/reply' => 'ReplyController',
]);

Route::post('like/{reply}', 'LikeController@likeIt');
Route::delete('like/{reply}', 'LikeController@unLikeIt');

// Notifications Route
Route::post('notifications', 'NewReplyNotificationController@index');
Route::post('markAsRead', 'NewReplyNotificationController@markAsRead');


// JWT Routes
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
