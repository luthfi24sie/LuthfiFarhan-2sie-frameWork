<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga_kk;
use App\Models\Warga;
use Illuminate\Http\Request;

class AnggotaKeluargaController extends Controller
{
  public function index(Request $request)
    {
        $query = AnggotaKeluarga::with(['kk', 'warga']);

        // 🔍 FILTER NAMA WARGA
        if ($request->filled('nama')) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // 🏠 FILTER KK
        if ($request->filled('kk_id')) {
            $query->where('kk_id', $request->kk_id);
        }

        $anggota = $query->latest()
                        ->paginate(20)
                        ->withQueryString();

        // data KK untuk dropdown filter
        $listKK = Keluarga_kk::orderBy('kk_nomor')->get();

        return view('admin.anggota_keluarga.index', compact('anggota', 'listKK'));
    }


    public function create()
    {
        $kk = Keluarga_kk::orderBy('kk_nomor')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('admin.anggota_keluarga.create', compact('kk', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk_id'     => 'required|exists:keluarga_kk,kk_id',
            'warga_id'  => 'required|exists:warga,warga_id',
            'hubungan'  => 'required|string|max:50',
        ]);

        AnggotaKeluarga::create($request->all());

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota keluarga berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = AnggotaKeluarga::findOrFail($id);
        $kk = Keluarga_kk::orderBy('kk_nomor')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('admin.anggota_keluarga.edit', compact('anggota', 'kk', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $anggota = AnggotaKeluarga::findOrFail($id);

        $request->validate([
            'kk_id'     => 'required|exists:keluarga_kk,kk_id',
            'warga_id'  => 'required|exists:warga,warga_id',
            'hubungan'  => 'required|string|max:50',
        ]);

        $anggota->update($request->all());

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota keluarga berhasil diperbarui');
    }

    public function show($id)
    {
        $anggota = AnggotaKeluarga::with(['kk.kepalaKeluarga', 'warga'])
            ->findOrFail($id);

        return view('admin.anggota_keluarga.show', compact('anggota'));
    }


    public function destroy($id)
    {
        AnggotaKeluarga::findOrFail($id)->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Anggota keluarga berhasil dihapus');
    }
}
