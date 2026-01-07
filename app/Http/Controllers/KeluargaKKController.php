<?php

namespace App\Http\Controllers;

use App\Models\Keluarga_kk;
use App\Models\Warga;
use Illuminate\Http\Request;

class KeluargaKKController extends Controller
{
    public function index(Request $request)
    {
        $filterable = ['rt', 'rw'];
        $searchable = ['kk_nomor', 'alamat'];

        $data = Keluarga_kk::with('kepalaKeluarga')
                ->filter($request, $filterable)
                ->search($request, $searchable)
                ->paginate(10)
                ->withQueryString();

        return view('admin.keluarga_kk.index', compact('data'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('admin.keluarga_kk.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk_nomor' => 'required|unique:keluarga_kk,kk_nomor',
            'kepala_keluarga_warga_id' => 'required',
        ]);

        Keluarga_kk::create($request->all());

        return redirect()->route('keluarga_kk.index')
                         ->with('success', 'KK Berhasil dibuat.');
    }

    public function show($id)
    {
        $kk = Keluarga_kk::with('kepalaKeluarga', 'anggota.warga')
                ->findOrFail($id);

        return view('admin.keluarga_kk.show', compact('kk'));
    }

    public function edit($id)
    {
        $kk = Keluarga_kk::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('admin.keluarga_kk.edit', compact('kk', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $kk = Keluarga_kk::findOrFail($id);

        $request->validate([
            'kk_nomor' => 'required|unique:keluarga_kk,kk_nomor,' . $id . ',kk_id',
        ]);

        $kk->update($request->all());

        return redirect()->route('keluarga_kk.index')
                         ->with('success', 'KK berhasil diupdate.');
    }

    public function destroy($id)
    {
        Keluarga_kk::findOrFail($id)->delete();

        return redirect()->route('keluarga_kk.index')
                         ->with('success', 'KK berhasil dihapus.');
    }
}
