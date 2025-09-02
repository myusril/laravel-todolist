<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyGuestMiddleware
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
        // Cek apakah session memiliki key "user" (artinya user sudah login)
        if ($request->session()->exists("user")) {
            // Jika user sudah login, redirect ke halaman home (/)
            return redirect("/");
        } else {
            // Jika user belum login, lanjutkan request ke proses berikutnya
            return $next($request);
        }
    }
}
