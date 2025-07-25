<?php

declare(strict_types=1);

namespace App\Http\Middleware\Auth;

use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            info('User is admin', ['user_id' => Auth::id()]);
            return $next($request);
        }

        return to_route('tasks.index', (['wsId' => session('wsId')]))->with('error', 'You do not have admin access.');
    }
}
