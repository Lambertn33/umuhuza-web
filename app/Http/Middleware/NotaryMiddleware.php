<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class NotaryMiddleware
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
        $notaryRole = Role::where('type', \App\Models\Role::NOTARY)->first();
        if (Auth::check()) {
            if (Auth::user()->role_id == $notaryRole->id) {
                if (Auth::user()->is_active) {
                    return $next($request);
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
