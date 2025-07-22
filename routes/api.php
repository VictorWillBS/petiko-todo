<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\SanctumAuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// login
Route::post('/login', [SanctumAuthController::class, 'login']);
// logout
Route::post('/logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');
// rota protegida

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tasks', TasksController::class)->middleware('auth:sanctum');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
