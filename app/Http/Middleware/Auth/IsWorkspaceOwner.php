<?php

declare(strict_types=1);

namespace App\Http\Middleware\Auth;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsWorkspaceOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next)
    {
        if (Workspace::find($request->route('wsId'))->owner_id === Auth::id()) {

            return $next($request);
        }

        return to_route('home')->with('error', 'You do not have workspace access.');
    }
}
