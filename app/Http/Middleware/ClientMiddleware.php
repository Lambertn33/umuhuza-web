<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        $clientRole = Role::where('type', \App\Models\Role::CLIENT)->first();
        if (Auth::check()) {
            if (Auth::user()->role_id == $clientRole->id) {
                if (Auth::user()->is_active) {
                    if (Auth::user()->has_updated_password) {
                        return $next($request);
                    } else {
                        return back();
                    }
                } else {
                   Auth::logout();
                   return redirect()->route('getLoginPage')->with('error','Your account is locked.. please contact the system administrator');
                }
            } else {
                return back();
            }
        } else {
            return back();
        }
    }
}
