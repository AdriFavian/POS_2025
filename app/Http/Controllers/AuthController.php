<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Cache\RateLimiting\Limiter;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:20',
            'password' => 'required|min:6|max:20'
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => '❌ Input tidak valid! Mohon periksa kembali data yang Anda masukkan.',
                    'msgField' => $validator->errors()
                ]);
            }
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('username', 'password');

        // Mengecek apakah IP sudah melebihi batas limit
        if (RateLimiter::tooManyAttempts('login-limit|' . $request->ip(), 5)) {
            // Dapatkan waktu reset limit
            $secondsLeft = RateLimiter::availableIn('login-limit|' . $request->ip());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kami mendeteksi aktivitas login yang tidak wajar, tunggu ' . $secondsLeft . ' detik.',
                    'seconds_left' => $secondsLeft,
                ]);
            }

            return redirect('login')->with('error', 'Kami mendeteksi aktivitas login yang tidak wajar, tunggu ' . $secondsLeft . ' detik.');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => ' Selamat datang, ' . Auth::user()->nama . '!.',
                    'redirect' => url('/')
                ]);
            }
            return redirect()->intended('/')->with('success', 'Halo, ' . Auth::user()->nama . '! Selamat Datang Kembali.');
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => false,
                'message' => '❌ "Login gagal! Pastikan username dan password yang Anda masukkan benar.'
            ]);
        }
        return redirect('login')->with('error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'Berhasil logout.');
    }
}
