<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
{
    // Cek apakah user sudah login DAN apakah rolenya sesuai
    if (!$request->user() || $request->user()->role !== $role) {
        abort(403, 'Waduh! Kamu nggak punya akses ke halaman ini.');
    }

    return $next($request);
}
}
