<?php

use App\Http\Controllers\QuestionOneController;
use App\Http\Controllers\QuestionTwoController;
use GrahamCampbell\ResultType\Success;
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

Route::middleware('auth.basic')->get('/test', function (Request $request) {
    return response()->json(['success' => 'true']);
});


Route::group(['middleware' => ['auth.bearer']], function () {
    Route::get('question/one', [QuestionOneController::class, 'scenario']);
    Route::get('question/two', [QuestionTwoController::class, 'scenario']);
});
