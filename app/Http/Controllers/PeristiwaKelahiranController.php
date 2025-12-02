<?php

namespace App\Http\Controllers;

use App\Models\PeristiwaKelahiran;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeristiwaKelahiranController extends Controller
{
    public function index()
    {
        $data = PeristiwaKelahiran::with('warga')->paginate(20);
        return view('admin.peristiwa_kelahiran.index', compact('data'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('admin.peristiwa_kelahiran.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'tgl_lahir' => 'required',
            'no_akta' => 'required|unique:peristiwa_kelahiran,no_akta',
        ]);

        PeristiwaKelahiran::create($request->all());

        return redirect()->route('admin.peristiwa_kelahiran.index')->with('success', 'Data kelahiran dicatat.');
    }

    public function show($id)
    {
        $data = PeristiwaKelahiran::with('warga', 'ayah', 'ibu', 'media')->findOrFail($id);
        return view('admin.peristiwa_kelahiran.show', compact('data'));
    }

    public function destroy($id)
    {
        PeristiwaKelahiran::findOrFail($id)->delete();
        return back()->with('success', 'Data kelahiran dihapus.');
    }
}
