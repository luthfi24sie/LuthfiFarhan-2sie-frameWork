<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Keluarga_kk;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KeluargaKKGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $keluarga = Keluarga_kk::with('kepalaKeluarga')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('kk_nomor', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhereHas('kepalaKeluarga', function ($relationQuery) use ($search) {
                            $relationQuery->where('nama', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('guest.keluarga_kk.index', [
            'keluarga' => $keluarga,
            'search' => $search,
            'totalKk' => Keluarga_kk::count(),
            'kepalaTerisi' => Keluarga_kk::whereNotNull('kepala_keluarga_warga_id')->count(),
        ]);
    }

    public function create()
    {
        return view('guest.keluarga_kk.create', [
            'kepalaOptions' => $this->kepalaOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        Keluarga_kk::create($validated);

        return redirect()
            ->route('guest.keluarga-kk.index')
            ->with('success', 'Data KK berhasil ditambahkan.');
    }

    public function edit(Keluarga_kk $keluarga_kk)
    {
        return view('guest.keluarga_kk.edit', [
            'keluarga' => $keluarga_kk,
            'kepalaOptions' => $this->kepalaOptions(),
        ]);
    }

    public function update(Request $request, Keluarga_kk $keluarga_kk)
    {
        $validated = $this->validatePayload($request, $keluarga_kk->kk_id);

        $keluarga_kk->update($validated);

        return redirect()
            ->route('guest.keluarga-kk.index')
            ->with('success', 'Data KK berhasil diperbarui.');
    }

    public function destroy(Keluarga_kk $keluarga_kk)
    {
        $keluarga_kk->delete();

        return redirect()
            ->route('guest.keluarga-kk.index')
            ->with('success', 'Data KK berhasil dihapus.');
    }

    protected function kepalaOptions()
    {
        $labelColumn = match (true) {
            Schema::hasColumn('warga', 'nama') => 'nama',
            Schema::hasColumn('warga', 'name') => 'name',
            Schema::hasColumn('warga', 'nama_lengkap') => 'nama_lengkap',
            default => 'id',
        };

        return Warga::orderBy($labelColumn)
            ->pluck($labelColumn, 'id');
    }

    protected function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        $kkUniqueRule = 'unique:keluarga_kk,kk_nomor';
        if ($ignoreId) {
            $kkUniqueRule .= ",{$ignoreId},kk_id";
        }

        return $request->validate([
            'kk_nomor' => ['required', 'string', 'max:100', $kkUniqueRule],
            'kepala_keluarga_warga_id' => ['nullable', 'exists:warga,id'],
            'alamat' => ['required', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
        ], [], [
            'kk_nomor' => 'Nomor KK',
            'kepala_keluarga_warga_id' => 'Kepala Keluarga',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
        ]);
    }
}
