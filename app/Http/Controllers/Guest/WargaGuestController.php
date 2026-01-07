<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaGuestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $agama = $request->query('agama');
        $pekerjaan = $request->query('pekerjaan');

        $warga = Warga::query()->with(['media', 'anggotaKeluarga.kk'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_ktp', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($agama, fn ($q) => $q->where('agama', $agama))
            ->when($pekerjaan, fn ($q) => $q->where('pekerjaan', 'like', "%{$pekerjaan}%"))
            ->orderByDesc('warga_id')
            ->paginate(10)
            ->withQueryString();

        return view('guest.warga.index', compact('warga', 'search', 'agama', 'pekerjaan'));
    }

    public function create()
    {
        return view('guest.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        // Simpan data warga (kecuali profile_photo dan documents karena disimpan terpisah)
        $warga = Warga::create(collect($validated)->except(['profile_photo', 'documents'])->all());

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('uploads/warga', 'public');
            
            Media::create([
                'ref_table' => 'warga',
                'ref_id' => $warga->warga_id,
                'file_url' => $path,
                'caption' => 'Foto Profil',
                'mime_type' => $file->getMimeType(),
                'sort_order' => 0,
            ]);
        }

        // Handle upload dokumen pendukung
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/warga_documents', 'public');
                Media::create([
                    'ref_table' => 'warga',
                    'ref_id' => $warga->warga_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pendukung',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('guest.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        $warga->load(['media', 'anggotaKeluarga.kk', 'kelahiran', 'kematian', 'pindah']);
        return view('guest.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $warga->load('media');
        return view('guest.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        $warga->update(collect($validated)->except(['profile_photo', 'documents'])->all());

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada (optional: bisa di-skip jika ingin keep history)
            // $oldPhoto = $warga->media()->where('caption', 'Foto Profil')->first();
            // if ($oldPhoto) Storage::disk('public')->delete($oldPhoto->file_url);

            $file = $request->file('profile_photo');
            $path = $file->store('uploads/warga', 'public');
            
            Media::create([
                'ref_table' => 'warga',
                'ref_id' => $warga->warga_id,
                'file_url' => $path,
                'caption' => 'Foto Profil',
                'mime_type' => $file->getMimeType(),
                'sort_order' => 0,
            ]);
        }

        // Handle upload dokumen pendukung baru
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/warga_documents', 'public');
                Media::create([
                    'ref_table' => 'warga',
                    'ref_id' => $warga->warga_id,
                    'file_url' => $path,
                    'caption' => 'Dokumen Pendukung',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }
        
        return redirect()->route('guest.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('guest.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
