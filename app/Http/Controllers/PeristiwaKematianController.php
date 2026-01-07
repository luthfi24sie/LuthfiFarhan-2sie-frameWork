<?php

namespace App\Http\Controllers;

use App\Models\PeristiwaKematian;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeristiwaKematianController extends Controller
{
   public function index(Request $request)
    {
        $query = PeristiwaKematian::with('warga');

        // 🔍 FILTER NAMA WARGA
        if ($request->filled('nama')) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // ⚠️ FILTER SEBAB KEMATIAN
        if ($request->filled('sebab')) {
            $query->where('sebab', 'like', '%' . $request->sebab . '%');
        }

        // 📅 FILTER TANGGAL MENINGGAL (RANGE)
        if ($request->filled('tgl_dari')) {
            $query->whereDate('tgl_meninggal', '>=', $request->tgl_dari);
        }

        if ($request->filled('tgl_sampai')) {
            $query->whereDate('tgl_meninggal', '<=', $request->tgl_sampai);
        }

        $data = $query->latest()
                    ->paginate(20)
                    ->withQueryString();

        return view('admin.peristiwa_kematian.index', compact('data'));
    }


    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('admin.peristiwa_kematian.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'tgl_meninggal' => 'required',
        ]);

        PeristiwaKematian::create($request->all());

        return redirect()->route('peristiwa_kematian.index')->with('success', 'Data kematian dicatat.');
    }

    public function show($id)
    {
        $data = PeristiwaKematian::with('warga', 'media')->findOrFail($id);
        return view('admin.peristiwa_kematian.show', compact('data'));
    }

    public function destroy($id)
    {
        PeristiwaKematian::findOrFail($id)->delete();
        return back()->with('success', 'Data kematian dihapus.');
    }
}
