<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Keluarga_kk;
use App\Models\PeristiwaKelahiran;
use App\Models\PeristiwaKematian;
use App\Models\PeristiwaPindah;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $wargaCount = Warga::count();
        $kkCount = Keluarga_kk::count();
        $kelahiranCount = PeristiwaKelahiran::count();
        $kematianCount = PeristiwaKematian::count();
        $pindahCount = PeristiwaPindah::count();
        $userCount = User::count();

        return view('guest.dashboard', compact(
            'wargaCount',
            'kkCount',
            'kelahiranCount',
            'kematianCount',
            'pindahCount',
            'userCount'
        ));
    }
}
