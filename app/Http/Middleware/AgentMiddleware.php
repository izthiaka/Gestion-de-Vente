<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = Role::where('code_role',  'AG')->first();

        if (Auth::user() &&  Auth::user()->role_id == $agent->id) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
