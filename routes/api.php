<?php


use App\Http\Controllers\RestAPI\AuthenticationController;
use App\Http\Controllers\RestAPI\LaporanController;
use App\Http\Controllers\RestAPI\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', [UserController::class, 'checkLogin']);


    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::post('/addPelaporan', [LaporanController::class, 'AddPelaporan']);
});

Route::get('/getPelaporan/{userId}', [LaporanController::class, 'getDataPelaporan']);
Route::post('users/password', [UserController::class, 'updatePassword']);
Route::post('users', [UserController::class, 'updateProfil']);

