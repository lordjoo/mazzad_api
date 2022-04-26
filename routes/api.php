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

Route::group([],function () {
    Route::post("/register",[\App\Http\Controllers\Api\Auth\RegistrationController::class,"register"]);
    Route::post("/oauth/token",[\App\Http\Controllers\Api\Auth\CustomOAuthController::class,"issueToken"]);
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix("/me")->group(function () {
        Route::get("/",[\App\Http\Controllers\Api\MeController::class,"me"]);
        Route::post("/updateProfile", [\App\Http\Controllers\Api\MeController::class, "updateProfile"]);
    });
});


