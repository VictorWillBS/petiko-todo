<?php

use App\Http\Controllers\Tasks\TasksController;
use App\Http\Middleware\Auth\IsAdmin;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');



Route::prefix('{wsId}')->middleware([])->group(function () {

    Route::patch('tasks/{id}/status', [TasksController::class, 'updateStatus'])
        ->name('tasks.updateStatus');
    Route::resource('tasks', TasksController::class)->middlewareFor(['store'], [IsAdmin::class]);
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
