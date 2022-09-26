<?php

namespace App\Http\Middleware;

use App\http\Service\SessionService;
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

        $user = SessionService::getUser($request);
        // dd($user->status === 1);
        if ($user->status === 1) {
            return $next($request);
        } 
        abort(401, 'You have been suspended, please contact Admin.');
        
    }
}
