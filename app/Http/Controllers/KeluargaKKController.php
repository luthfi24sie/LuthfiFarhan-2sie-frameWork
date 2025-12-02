<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluargaKKController extends Controller
{
    public function index(Request $request)
    {
         $data['dataKeluarga_kk'] = Keluarga_kk::all();
        return view('admin.keluarga_kk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
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
         $data['dataKeluarga_kk'] = Keluarga_kk::findOrFail($id);
        return view('admin.keluarga_kk.edit', $data);
    }

    public function update(Request $request, $id)
    {
       $keluarga = Keluarga_kk::findOrFail($id);

    $keluarga->kk_nomor = $request->kk_nomor;
    $keluarga->kepala_keluarga_warga_id = $request->kepala_keluarga_warga_id;
    $keluarga->alamat = $request->alamat;
    $keluarga->rt = $request->rt;
    $keluarga->rw = $request->rw;

    $keluarga->save();

    return redirect()->route('keluarga_kk.index')->with('success','Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $keluarga = Keluarga_kk::findOrFail($id);
    $keluarga->delete();
    return redirect()->route('keluarga_kk.index')->with('success', 'Data berhasil dihapus');

    }
}
