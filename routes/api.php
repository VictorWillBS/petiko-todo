<?php

use App\Http\Controllers\Auth\SanctumAuthController;
use App\Http\Controllers\Tasks\TasksController;
use App\Http\Middleware\Auth\IsAdmin;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [SanctumAuthController::class, 'register']);
Route::post('/login', [SanctumAuthController::class, 'login']);
Route::post('/logout', [SanctumAuthController::class, 'logout'])->middleware('auth:sanctum');
// rota protegida

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tasks', TasksController::class)->middlewareFor(['store'], IsAdmin::class);;
});
