<?php

namespace App\Http\Middleware;

use App\http\Service\SessionService;
use App\Models\Admin;
use App\Models\User;
use App\Models\vendor;
use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $user = SessionService::getUser($request);
             dd($user->type);
        // if ($role === 'user' && !User::find($request->user()->unique_id)) abort(401);
        // if ($role === 'vendor' && !Vendor::find($request->user()->unique_id)) abort(401);
        // if ($role === 'admin' && !Admin::find($request->user()->unique_id)) abort(401);
        if ($user->type === "vendor" || "admin" && $role === "vendor" || "admin") {
        } elseif ($user->type === "user" || "admin" && $role === "user" || "admin") {
        } elseif ($user->type === "admin" && $role === "admin") {
        } else {

            abort(401, 'Unauthorized action.');
        }

        auth()->shouldUse($role);
        return $next($request);
    }
}

