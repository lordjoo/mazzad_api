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

Resource Category
getAll GET | /category/
create POST | /category/
single GET | /category/{id}
delete DELETE | / category/{id}
edit PATCH|POST | /category/{id}
*/

// Routes No Need For Auth
Route::group([],function () {
    Route::post("/register",[\App\Http\Controllers\Api\Auth\RegistrationController::class,"register"]);
    Route::post("/oauth/token",[\App\Http\Controllers\Api\Auth\CustomOAuthController::class,"issueToken"]);

    Route::prefix("/category")->group(function(){
        Route::get("/", [\App\Http\Controllers\Api\CategoryController::class, "all"]);
    });

    // TODO: add the rest of auction routes

});

// Routes Need auth
Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix("/me")->group(function () {
        Route::get("/",[\App\Http\Controllers\Api\MeController::class,"me"]);
        Route::post("/updateProfile", [\App\Http\Controllers\Api\MeController::class, "updateProfile"]);
    });
    Route::prefix("/auction")->group(function(){
        Route::post("/", [\App\Http\Controllers\Api\AuctionController::class, "create"]);
        Route::post("/{id}", [\App\Http\Controllers\Api\AuctionController::class, "edit"]);
        Route::delete("/{id}", [\App\Http\Controllers\Api\AuctionController::class, "delete"]);
        Route::get("/", [\App\Http\Controllers\Api\AuctionController::class, "get"]);
    });
});


