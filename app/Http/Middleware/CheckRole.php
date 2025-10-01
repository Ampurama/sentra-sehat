<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            // Arahkan ke halaman login jika belum terautentikasi
            return redirect('/login'); 
        }

        $user = Auth::user();
        
        // 2. Cek apakah user memiliki Role yang terlampir
        if (!$user->role) {
            // Log ini harus diperiksa di log Laravel jika sering terjadi
            return redirect('/home')->with('error', 'Akses ditolak: Data peran pengguna tidak valid.');
        }

        // 3. Ambil nama role user dan bersihkan (trim) dari spasi tak terlihat
        $userRoleName = trim($user->role->name); 

        // 4. Verifikasi Otorisasi: Cek apakah nama role yang dibersihkan ada di daftar roles yang diizinkan
        if (in_array($userRoleName, $roles)) {
            return $next($request); // Lanjutkan request (Otorisasi Sukses)
        }

        // 5. Jika tidak diizinkan
        return redirect('/home')->with('error', 'Akses ditolak: Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}