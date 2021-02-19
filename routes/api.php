<?php

use App\Http\Controllers\Api\Media\MediaController;
use App\Http\Controllers\Api\Media\MediaTypesController;
use App\Http\Controllers\Api\Timeline\TimelineController;
use App\Http\Controllers\Api\Tweets\TweetController;
use App\Http\Controllers\Api\Tweets\TweetLikeController;
use App\Http\Controllers\Api\Tweets\TweetRetweetController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/media/types', [MediaTypesController::class, 'index']);
Route::post('/media', [MediaController::class, 'store']);

Route::group(['prefix' => 'timeline'], function (){
    Route::get('/', [TimelineController::class, 'index']);

    Route::post('/tweets', [TweetController::class, 'store']);
    Route::post('/tweets/{tweet}/likes', [TweetLikeController::class, 'store']);
    Route::delete('/tweets/{tweet}/likes', [TweetLikeController::class, 'destroy']);

    Route::post('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'store']);
    Route::delete('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'destroy']);
});
