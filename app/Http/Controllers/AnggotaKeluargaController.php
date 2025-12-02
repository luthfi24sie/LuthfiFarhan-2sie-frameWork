<?php

namespace App\Http\Controllers;

use App\Models\KeluargaKK;
use App\Models\Warga;
use Illuminate\Http\Request;

class KeluargaKKController extends Controller
{
    public function index()
    {
        try {
            $anggota = AnggotaKeluarga::orderBy('anggota_id', 'desc')->paginate(10);
            return view('anggota_keluarga.index', compact('anggota'));
        } catch (\Exception $e) {
            // Fallback jika ada error
            $anggota = collect();
            return view('anggota_keluarga.index', compact('anggota'));
        }
    }

    public function create(): View
    {
        return view('anggota_keluarga.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'kk_id' => ['required', 'integer', 'min:1'],
                'warga_id' => ['required', 'integer', 'min:1'],
                'hubungan' => ['required', 'string', 'max:50'],
            ]);

            AnggotaKeluarga::create($validated);
            return redirect()->route('anggota-keluarga.index')->with('success', 'Data anggota keluarga berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $kk = KeluargaKK::with('kepalaKeluarga', 'anggota.warga')->findOrFail($id);
        return view('admin.kk.show', compact('kk'));
    }

    public function edit($id)
    {
        $kk = KeluargaKK::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('admin.kk.edit', compact('kk', 'warga'));
    }

    public function update(Request $request, AnggotaKeluarga $anggota_keluarga): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'kk_id' => ['required', 'integer', 'min:1'],
                'warga_id' => ['required', 'integer', 'min:1'],
                'hubungan' => ['required', 'string', 'max:50'],
            ]);

            $anggota_keluarga->update($validated);
            return redirect()->route('anggota-keluarga.index')->with('success', 'Data anggota keluarga berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $anggota_keluarga->delete();
            return redirect()->route('anggota-keluarga.index')->with('success', 'Data anggota keluarga berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('anggota-keluarga.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}


