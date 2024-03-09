<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\ApiUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(ApiUserController::class)
->prefix('/users')
->group(function(){
    Route::get('/','index'); // list users
    Route::get('/{id}','show'); // show users
    Route::post('/','store'); // create users
    Route::put('/{id}','update'); // update users
    Route::delete('/{id}','destroy'); // delete users
});
