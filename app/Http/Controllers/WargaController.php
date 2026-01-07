<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $warga = Warga::query()
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.warga.index', compact('warga', 'search'));
    }

    public function create()
    {
        return view('admin.warga.create');
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
        ]);

        $warga = Warga::create(collect($validated)->except(['profile_photo'])->all());

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

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        $warga->load(['media', 'anggotaKeluarga.kk']);
        return view('admin.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        return view('admin.warga.edit', compact('warga'));
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
        ]);

        $warga->update(collect($validated)->except(['profile_photo'])->all());

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

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
