<?php

use App\Http\Controllers\DevotionalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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

Route::get('/devotionals', [DevotionalController::class, 'index']);

// Route::post('/devotionals', function(){
//    // return 'devotionals';
//    return Devotional::create([
//     'title' => 'Discipleship',
//     'content' => 'The core of discipleship is availability.',
//     'date' => '2024-09-06 11:28:32',
//     'audio_path' => '',
//    ]);
// });

//Public routes
Route::get('/devotionals', [DevotionalController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/devotionals/filter', [DevotionalController::class, 'filter']);
Route::get('/devotionals/{id}', [DevotionalController::class, 'show']);
Route::put('/devotionals/{id}/pageview', [DevotionalController::class, 'pageview']);

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/comments/{id}', [CommentController::class, 'show']);


//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/devotionals', [DevotionalController::class, 'store']);
    Route::put('/devotionals/{id}', [DevotionalController::class, 'update']);
    Route::delete('/devotionals/{id}', [DevotionalController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

//Route::resource('devotionals', DevotionalController::class);
//Route::get('/devotionals/search', [DevotionalController::class, 'search']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});




