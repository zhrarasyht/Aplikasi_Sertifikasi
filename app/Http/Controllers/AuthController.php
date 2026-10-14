<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Memeriksa status akun User
            if ($user->role === 'user' && $user->status !== 'approved') {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Akun kamu belum disetujui admin.',
                    ])
                    ->onlyInput('email');
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        $skemas = SkemaSertifikasi::all();

        return view('auth.register', compact('skemas'));
    }

    public function register(Request $request)
    {
        // Memvalidasi data yang dikirim dari form register
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nisn' => 'required|digits:10|unique:pesertas,nisn',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telepon' => 'nullable|regex:/^[0-9]{1,13}$/',
            'alamat' => 'nullable|string|max:1000',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
        ], [
            // Pesan yang ditampilkan jika validasi gagal
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.digits' => 'NISN harus terdiri dari 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
            'no_telepon.regex' => 'Nomor telepon hanya boleh berisi angka, maksimal 13 digit.',
            'skema_sertifikasi_id.required' => 'Skema sertifikasi wajib dipilih.',
            'skema_sertifikasi_id.exists' => 'Skema sertifikasi tidak valid.',
        ]);

        // Menjalankan penyimpanan dalam satu transaksi database
        DB::transaction(function () use ($validated) {

            // Membuat akun pengguna baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
                'status' => 'approved',
            ]);

            // Menyimpan data peserta dan menghubungkannya
            // dengan akun pengguna yang baru dibuat
            Peserta::create([
                'user_id' => $user->id,
                'nama_peserta' => $validated['name'],
                'nisn' => $validated['nisn'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'email' => $validated['email'],
                'no_telepon' => $validated['no_telepon'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'skema_sertifikasi_id' => $validated['skema_sertifikasi_id'],
            ]);
        });

        // Kembali ke halaman login dengan pesan berhasil
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
