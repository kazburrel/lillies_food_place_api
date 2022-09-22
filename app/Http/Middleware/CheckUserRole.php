<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next, $role) {

        if ($role === 'user' && !User::find($request->user()->unique_id)) ;
        if ($role === 'vendor' && !Vendor::find($request->user()->unique_id)) ;
        if ($role === 'admin' && !Admin::find($request->user()->unique_id)) ;
            
    

        auth()->shouldUse($role);


        return $next($request);
    }

    // public function handle(Request $request, Closure $next, $role) {
    //     if ($request->user()->tokenCan('role:' . $role)) {
    //         auth()->shouldUse($role);
    //         return $next($request);
    //     }
    //     return response()->json([
    //         'message'=> 'Not Authenticated'
    //     ]);
    // }
    // Found the solution. Instead of $user = User::find($request->user_id) I now use $user = $request->user()

    // public function handle($request, Closure $next, ...$abilities)
    // {
    //     foreach ($abilities as $ability) {
    //         if (!$request->user()->tokenCan($ability)) {
    //             abort(400, 'Access denied');
    //         }
    //     }

    //     return $next($request);
    // }
}

// class CheckUserRole
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//      * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//      */
//     public function handle(Request $request, Closure $next, $role) {
//         auth()->shouldUse($role);
//         return $next($request);
//     }
// }
