<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/')->withErrors([
                'email' => 'Silakan login terlebih dahulu.'
            ]); // arahkan ke login
        }

        $roleName = Role::find(Auth::user()->role_id)->name ?? null;
        // Cek apakah user sudah login
        if (!in_array($roleName, $roles)) {
            return redirect()->route('login'); // arahkan ke login
        }

        return $next($request);
    }
}
