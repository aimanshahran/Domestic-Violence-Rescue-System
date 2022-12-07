<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {
        if (Auth::check()){
            $roles = [
                'Admin' => [1],
                'User' => [2],
                'Counselor' => [3],
                'Writer' => [4],
                'Admin-Writer' => [1,4],
                'AllUser' => [1,2,3,4]
                ];

            $roleIds = $roles[$role] ?? [];

            if(!in_array(Auth::user()->role_id, $roleIds)){
                abort(401); // Show error if not authorized.
            }

            return $next($request); //Return to requested page.
        }else{
            return redirect('/login')->with('message', 'Please login to use this function');

        }
    }
}
