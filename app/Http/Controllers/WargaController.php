<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
  public function index()
{
    $warga = Warga::orderBy('id', 'desc')->paginate(10); // ganti warga_id jadi id
    return view('warga.index', compact('warga'));
}


    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required|string',
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }


    public function show(Warga $warga)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.show', compact('warga'));
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
{
    $request->validate([
        'no_ktp' => 'required|unique:warga,no_ktp,' . $warga->id . ',id', // ganti warga_id jadi id
        // ... validasi lainnya
    ]);

    $warga->update($request->all());
    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
}

    public function destroy($id)
    {
        Warga::findOrFail($id)->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}

