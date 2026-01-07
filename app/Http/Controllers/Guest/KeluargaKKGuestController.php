<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Keluarga_kk;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KeluargaKKGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $keluarga = Keluarga_kk::with(['kepalaKeluarga.media', 'media'])
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

        $kk = Keluarga_kk::create(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kk_documents', 'public');
                Media::create([
                    'ref_table' => 'keluarga_kk',
                    'ref_id' => $kk->kk_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pendukung',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

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

        $keluarga_kk->update(collect($validated)->except('documents')->toArray());

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/kk_documents', 'public');
                Media::create([
                    'ref_table' => 'keluarga_kk',
                    'ref_id' => $keluarga_kk->kk_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pendukung',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()
            ->route('guest.keluarga-kk.index')
            ->with('success', 'Data KK berhasil diperbarui.');
    }

    public function show(Keluarga_kk $keluarga_kk)
    {
        $keluarga_kk->load(['kepalaKeluarga.media', 'anggota.warga', 'media']);
        return view('guest.keluarga_kk.show', ['keluarga' => $keluarga_kk]);
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
            default => 'warga_id',
        };

        return Warga::orderBy($labelColumn)
            ->pluck($labelColumn, 'warga_id');
    }

    protected function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        $kkUniqueRule = 'unique:keluarga_kk,kk_nomor';
        if ($ignoreId) {
            $kkUniqueRule .= ",{$ignoreId},kk_id";
        }

        return $request->validate([
            'kk_nomor' => ['required', 'string', 'max:100', $kkUniqueRule],
            'kepala_keluarga_warga_id' => ['nullable', 'exists:warga,warga_id'],
            'alamat' => ['required', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'documents.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],
        ], [], [
            'kk_nomor' => 'Nomor KK',
            'kepala_keluarga_warga_id' => 'Kepala Keluarga',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
        ]);
    }
}
