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
    Route::prefix("/password")->group(function () {
        Route::post("/request", [\App\Http\Controllers\Api\Auth\ResetPasswordController::class,"requestReset"]);
        Route::post("/reset", [\App\Http\Controllers\Api\Auth\ResetPasswordController::class,"resetPassword"]);
        Route::post("/verify-otp", [\App\Http\Controllers\Api\Auth\ResetPasswordController::class,"verifyOtp"]);
    });
    Route::get("/auction/", [\App\Http\Controllers\Api\AuctionController::class, "get"]);
    Route::get("/auction/search", [\App\Http\Controllers\Api\AuctionController::class, "search"]);
    Route::get("/slider/",[\App\Http\Controllers\Api\SliderController::class,"get"]);
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
        Route::get("/{id}",[\App\Http\Controllers\Api\AuctionController::class, "getAuctionByCategory"]);
        Route::get("/", [\App\Http\Controllers\Api\AuctionController::class, "searchForAuction"]);
        Route::get("/{auction_id}/bid/{amount}", [\App\Http\Controllers\Api\AuctionBidController::class, "placeBid"]);
        Route::get('/{id}', [\App\Http\Controllers\Api\AuctionBidController::class, "getBids"]);
    });

    Route::post("/recordAction",[\App\Http\Controllers\Api\UserActionController::class,"recordAction"]);
    // General Routes
    Route::post("/upload", [\App\Http\Controllers\Api\General\UploadFileController::class,"upload"]);
});


