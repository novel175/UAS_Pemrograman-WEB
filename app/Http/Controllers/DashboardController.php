<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard sesuai role user.
     */
    public function index()
    {
        $user = Auth::user();

        // Pastikan pengguna sudah login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Arahkan ke dashboard sesuai role
        if ($user->hasRole('admin')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('editor')) {
            return view('editor.dashboard');
        } elseif ($user->hasRole('wartawan')) {
            return view('wartawan.dashboard');
        }

        // Default view jika role tidak dikenali
        return view('dashboard');
    }
}
