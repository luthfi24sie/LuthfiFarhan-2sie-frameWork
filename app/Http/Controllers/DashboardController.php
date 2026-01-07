<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Keluarga_kk;
use App\Models\AnggotaKeluarga;
use App\Models\Media;
use App\Models\PeristiwaKelahiran;
use App\Models\PeristiwaKematian;
use App\Models\PeristiwaPindah;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [

            // ================= TOTAL =================
            'totalWarga'      => Warga::count(),
            'totalKK'         => Keluarga_kk::count(),
            'totalAnggota'    => AnggotaKeluarga::count(),
            'totalMedia'      => Media::count(),
            'totalKelahiran'  => PeristiwaKelahiran::count(),
            'totalKematian'   => PeristiwaKematian::count(),
            'totalPindah'     => PeristiwaPindah::count(),

            // ================= LATEST DATA =================
            'latestWarga' => Warga::latest()
                ->take(5)
                ->get(),

            'latestKK' => Keluarga_kk::with('kepalaKeluarga')
                ->latest()
                ->take(5)
                ->get(),

            'latestAnggota' => AnggotaKeluarga::with(['warga', 'kk'])
                ->latest()
                ->take(5)
                ->get(),

            'latestMedia' => Media::latest()
                ->take(5)
                ->get(),

            'latestKelahiran' => PeristiwaKelahiran::with('warga')
                ->latest()
                ->take(5)
                ->get(),

            'latestKematian' => PeristiwaKematian::with('warga')
                ->latest()
                ->take(5)
                ->get(),

            'latestPindah' => PeristiwaPindah::with('warga')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
