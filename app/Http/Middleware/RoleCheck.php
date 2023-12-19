<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Log;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        Log::info('RoleCheck Middleware: User Role - ' . $request->user()->role);

        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        } else {
            if ($request->user()->role == "deactivate") {
                Auth::logout();
                return redirect('/login')->with('status', 'Maaf Akun Anda Dinonaktifkan');
            } else if ($request->user()->role == "user") {
                return redirect('/dashboard')->with('status', 'Maaf Anda Tidak Memiliki Hak Akses');
            } else if ($request->user()->role == "admin") {
                return $next($request);
            }

            return redirect('/');
        }
    }
}
