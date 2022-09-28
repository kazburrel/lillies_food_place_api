<?php

namespace App\Http\Middleware;

use App\http\Service\SessionService;
use App\Models\User;
use App\Models\Vendor;
use Closure;
use Illuminate\Http\Request;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // $user = SessionService::getUser($request);
        if ($request->status === 0) {
            return abort(401, 'You have been suspended, please contact Admin.');
        } 
        return $next($request);
        
    }
}
