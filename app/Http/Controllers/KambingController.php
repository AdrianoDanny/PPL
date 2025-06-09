<?php

namespace App\Http\Controllers;

use App\Models\Kambing;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KambingController extends Controller
{
    public function index()
    {
        $user = Auth::guard('akun')->user();

        if ($user->role === 'admin') {
            // Admin bisa melihat semua kambing
            $kambings = Kambing::with('pemasok.akun')->paginate(10);
        } elseif ($user->role === 'pemasok') {
            // Pemasok hanya melihat kambing miliknya
            $profil = $user->profil;
            $kambings = Kambing::where('pemasok_id', $profil->id)
                              ->with('pemasok.akun')
                              ->paginate(10);
        } else {
            abort(403, 'Unauthorized');
        }

        return view('kambing.index', compact('kambings'));
    }

    public function create()
    {
        $user = Auth::guard('akun')->user();

        if ($user->role === 'admin') {
            // Admin bisa pilih pemasok mana saja
            $pemasoks = Profil::whereHas('akun', function($query) {
                $query->where('role', 'pemasok');
            })->get();
        } elseif ($user->role === 'pemasok') {
            // Pemasok hanya bisa input untuk dirinya
            $pemasoks = collect([$user->profil]);
        } else {
            abort(403, 'Unauthorized');
        }

        return view('kambing.create', compact('pemasoks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'berat' => 'required|numeric|min:1',
            'usia' => 'required|integer|min:1',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'pemasok_id' => 'required|exists:profils,id',
            'foto_kambing' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_tersedia' => 'boolean'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto_kambing')) {
            $file = $request->file('foto_kambing');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kambing', $filename);
            $data['foto_kambing'] = $filename;
        }

        $data['status_tersedia'] = $request->has('status_tersedia');

        Kambing::create($data);

        return redirect()->route('kambing.index')
                        ->with('success', 'Data kambing berhasil ditambahkan!');
    }

    public function show(Kambing $kambing)
    {
        $this->authorizeKambing($kambing);
        return view('kambing.show', compact('kambing'));
    }

    public function edit(Kambing $kambing)
    {
        $this->authorizeKambing($kambing);

        $user = Auth::guard('akun')->user();

        if ($user->role === 'admin') {
            $pemasoks = Profil::whereHas('akun', function($query) {
                $query->where('role', 'pemasok');
            })->get();
        } else {
            $pemasoks = collect([$user->profil]);
        }

        return view('kambing.edit', compact('kambing', 'pemasoks'));
    }

    public function update(Request $request, Kambing $kambing)
    {
        $this->authorizeKambing($kambing);

        $request->validate([
            'berat' => 'required|numeric|min:1',
            'usia' => 'required|integer|min:1',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'pemasok_id' => 'required|exists:profils,id',
            'foto_kambing' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_tersedia' => 'boolean'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto_kambing')) {
            // Delete old photo
            if ($kambing->foto_kambing) {
                Storage::delete('public/kambing/' . $kambing->foto_kambing);
            }

            $file = $request->file('foto_kambing');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kambing', $filename);
            $data['foto_kambing'] = $filename;
        }

        $data['status_tersedia'] = $request->has('status_tersedia');

        $kambing->update($data);

        return redirect()->route('kambing.index')
                        ->with('success', 'Data kambing berhasil diperbarui!');
    }

    private function authorizeKambing(Kambing $kambing)
    {
        $user = Auth::guard('akun')->user();

        if ($user->role === 'pemasok') {
            // Pemasok hanya bisa akses kambing miliknya
            if ($kambing->pemasok_id !== $user->profil->id) {
                abort(403, 'Unauthorized');
            }
        } elseif (!in_array($user->role, ['admin', 'pemasok'])) {
            abort(403, 'Unauthorized');
        }
    }
}
