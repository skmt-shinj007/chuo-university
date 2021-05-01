<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TwitterApiController;

use App\Http\Resources\MemberResource;
use App\Models\UserProfile;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'twitter'], function () {
    Route::get('/timeline', [TwitterApiController::class, 'getTimeline']);
    Route::get('/account', [TwitterApiController::class, 'getAccount']);
    Route::get('/provider', [TwitterApiController::class, 'getProvider']);
});

// endpoint: /member
Route::get('member', function () {
    return MemberResource::collection(UserProfile::all());
});