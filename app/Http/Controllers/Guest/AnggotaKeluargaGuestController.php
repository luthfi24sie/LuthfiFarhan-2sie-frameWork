<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluarga;
use App\Models\Keluarga_kk;
use Illuminate\Http\Request;

class AnggotaKeluargaGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $hubungan = $request->query('hubungan');
        $kk = $request->query('kk');
        
        $anggota = AnggotaKeluarga::with(['kk', 'warga'])
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('warga', function ($subQ) use ($search) {
                        $subQ->where('nama', 'like', "%{$search}%");
                    })
                    ->orWhere('hubungan', 'like', "%{$search}%");
                });
            })
            ->when($hubungan, function ($query) use ($hubungan) {
                $query->where('hubungan', 'like', "%{$hubungan}%");
            })
            ->when($kk, function ($query) use ($kk) {
                $query->whereHas('kk', function ($q) use ($kk) {
                    $q->where('kk_nomor', 'like', "%{$kk}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('guest.anggota_keluarga.index', compact('anggota', 'search', 'hubungan', 'kk'));
    }

    public function show($id)
    {
        $anggota = AnggotaKeluarga::with(['kk.kepalaKeluarga', 'warga'])
            ->findOrFail($id);

        return view('guest.anggota_keluarga.show', compact('anggota'));
    }
}
