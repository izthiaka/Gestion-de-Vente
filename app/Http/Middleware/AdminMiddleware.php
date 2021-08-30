<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $admin = Role::where('code_role',  'AD')->first();

        if (Auth::user() &&  Auth::user()->role_id == $admin->id) {
            return $next($request);
        }

        return redirect('/admin/dashboard');
    }
}
