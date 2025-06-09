<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Profil;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('components.login');
    }

    public function login() {
        return view('admin.dashboard');
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $akun = Akun::where('email', $request->email)->first();

    //     if ($akun && Hash::check($request->password, $akun->password)) {
    //         Auth::guard('akun')->login($akun);

    //         // Redirect berdasarkan role[1][3][4][6]
    //         switch ($akun->role) {
    //             case 'admin':
    //                 return redirect()->route('admin.dashboard');
    //             case 'pemasok':
    //                 return redirect()->route('pemasok.dashboard');
    //             case 'customer':
    //                 return redirect()->route('customer.dashboard');
    //             default:
    //                 return redirect()->route('login');
    //         }
    //     }

    //     return back()->withErrors([
    //         'email' => 'Email atau password salah'
    //     ]);
    // }

    public function showRegisterForm()
    {
        $kabupatens = Kabupaten::all();
        return view('components.register', ['kabupatens' => $kabupatens]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:akuns,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,pemasok,customer',
            'no_hp' => 'required|string|max:20',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'detail_alamat' => 'required|string|max:255'
        ]);

        DB::beginTransaction();
        try {
            // Buat alamat[5]
            $alamat = Alamat::create([
                'kecamatan_id' => $request->kecamatan_id,
                'detail' => $request->detail_alamat
            ]);

            // Buat akun
            $akun = Akun::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            // Buat profil
            Profil::create([
                'akun_id' => $akun->id,
                'nama' => $request->nama,
                'alamat_id' => $alamat->id,
                'no_hp' => $request->no_hp
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', 'Registrasi berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat registrasi']);
        }
    }

    public function logout()
    {
        Auth::guard('akun')->logout();
        return redirect()->route('login');
    }

    // AJAX untuk mendapatkan kecamatan berdasarkan kabupaten
    public function getKecamatan($kabupatenId)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupatenId)->get();
        return response()->json($kecamatans);
    }
}
