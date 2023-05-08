<?php

use App\Http\Controllers\API\PromotersController;
use App\Http\Controllers\API\SanctumAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [SanctumAuthController::class, 'login']);
Route::get('promoters', [PromotersController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {



    Route::post('logout', [SanctumAuthController::class, 'logout']);


    /*Route::group(['prefix'=>'my-account','as'=>'my-account.'], function(){
        Route::post('profile', [SanctumAuthController::class, 'profile']);
        Route::post('gallery', [SanctumAuthController::class, 'gallery']);
    });*/




});
