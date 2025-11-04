<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // Ambil user yang sedang login
                $user = Auth::guard($guard)->user();
                // ATAU jika kamu pakai satu guard tapi punya kolom `role` di tabel users:
                switch ($user->role) {
                    case 'admin':
                        return redirect('/admin/dashboard');
                    case 'student':
                        return redirect('/student/dashboard');
                    case 'teacher':
                        return redirect('/teacher/dashboard');
                    default:
                        return redirect(RouteServiceProvider::DASHBOARD);
                }
            }
        }

        return $next($request);
    }
}
