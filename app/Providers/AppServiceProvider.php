<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Workspace;
use App\Modules\Users\Repositories\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'appName' => config('app.name'),
            'appVersion' => config('app.version'),
            'auth.user' => fn() => Auth::user() ? Auth::user()->only(['id', 'name', 'email']) : null,
            'flash' => [
                'success' => fn() => session('success'),
                'error' => fn() => session('error'),
            ],
            'wsId' => session('wsId'),
            'collaborators' => fn () => User::inWorkspace(session('wsId', 10))->get(),
        ]);
    }
}
