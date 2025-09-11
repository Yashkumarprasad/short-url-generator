<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModulePermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user();
        $routeName = $request->route()->getName();

        if ($user->user_type == SUPER_ADMIN && in_array($routeName, ['admin.url.add', 'admin.url.store'])) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied for super admin on this action.');
        }

        if ($user->user_type == MEMBER && in_array($routeName, ['admin.user.list', 'admin.user.add', 'admin.user.store'])) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied for memberr on this section.');
        }

        return $next($request);
    }
}
