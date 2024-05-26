<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLogin
{
    public function handle($request, Closure $next, $roles)
    {
        // Cek apakah pengguna telah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Cek apakah pengguna memiliki role yang sesuai
        $user = Auth::user();
        if ($user->level_id == $roles) {
            return $next($request);
        }

        return redirect('login')->with('error', 'Anda tidak memiliki akses');
    }
}
