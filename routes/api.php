<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>["auth:sanctum"]],function(){
    Route::get("/osszes_foglalas", [ContactController::class, "index"]);

    Route::put("/foglalas_frissites/{id}",[ContactController::class ,"update"]);
    Route::delete("/foglalas_torlese/{id}",[ContactController::class ,"destroy"]);

});



Route::post("/register", [AdminController::class,"register"]);
Route::post("/login", [AdminController::class,"login"]);




Route::post('/sendmail', [ContactController::class, 'send']);
Route::post('/res', [ContactController::class, 'create']);
