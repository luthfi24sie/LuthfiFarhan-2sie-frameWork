<?php

namespace App\Http\Controllers;

use App\Models\PeristiwaPindah;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeristiwaPindahController extends Controller
{
   public function index(Request $request)
    {
        $query = PeristiwaPindah::with('warga');

        // 🔍 FILTER NAMA WARGA
        if ($request->filled('nama')) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // 📄 FILTER NO SURAT
        if ($request->filled('no_surat')) {
            $query->where('no_surat', 'like', '%' . $request->no_surat . '%');
        }

        $pindah = $query->latest()
                        ->paginate(20)
                        ->withQueryString();

        return view('admin.peristiwa_pindah.index', compact('pindah'));
    }

    public function edit($id)
    {
        $data = PeristiwaPindah::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();

        return view('admin.peristiwa_pindah.edit', compact('data', 'warga'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'warga_id'     => 'required',
        'tgl_pindah'   => 'required',
        'alamat_tujuan'=> 'required',
        'alasan'       => 'nullable|string',
        'no_surat'     => 'nullable|string',
    ]);

    $data = PeristiwaPindah::findOrFail($id);
    $data->update($request->all());

    return redirect()
        ->route('peristiwa_pindah.index')
        ->with('success', 'Data pindah berhasil diperbarui.');
}



    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('admin.peristiwa_pindah.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'tgl_pindah' => 'required',
        ]);

        PeristiwaPindah::create($request->all());

        return redirect()->route('peristiwa_pindah.index')->with('success', 'Data pindah dicatat.');
    }

    public function show($id)
    {
        $data = PeristiwaPindah::with('warga', 'media')->findOrFail($id);
        return view('admin.peristiwa_pindah.show', compact('data'));
    }

    public function destroy($id)
    {
        PeristiwaPindah::findOrFail($id)->delete();
        return back()->with('success', 'Data pindah dihapus.');
    }
}
