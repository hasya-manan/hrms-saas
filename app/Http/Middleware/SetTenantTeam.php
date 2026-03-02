<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;

class SetTenantTeam
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            app(PermissionRegistrar::class)
                ->setPermissionsTeamId(auth()->user()->tenant_id);
        }

        return $next($request);
    }
}