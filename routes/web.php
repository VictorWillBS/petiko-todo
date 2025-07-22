<?php

use App\Http\Controllers\Tasks\TasksController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('tasks', TasksController::class)->middleware(['auth', 'verified'])
    ->middlewareFor(['store'], ['IsAdmin']);


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
