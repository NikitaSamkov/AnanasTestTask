<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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

Route::post('/register', [AuthController::class, "Register"]);
Route::post('/login', [AuthController::class, "Login"])->name("login");

Route::prefix("/messages")->group(function () {
    Route::middleware("auth:sanctum")->post('/upload', [MessageController::class, "UploadMessage"]);
    Route::middleware("auth:sanctum")->post('/delete', [MessageController::class, "DeleteMessage"]);
    Route::get("", [MessageController::class, "GetMessages"]);
});

