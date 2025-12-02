<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /** 
     * Menampilkan daftar media
     */
    public function index()
    {
        // Gunakan variabel $media agar cocok dengan view
        $media = Media::latest()->paginate(20);
        return view('admin.media.index', compact('media'));
    }

    /**
     * Hapus media + file fisik.
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file fisik jika ada
        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }

    /**
     * Upload media manual (opsional)
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id' => 'required|integer',
            'file' => 'required|file|max:5000',
        ]);

        $path = $request->file('file')->store('uploads/' . $request->ref_table, 'public');

        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id'    => $request->ref_id,
            'file_url'  => $path,
            'caption'   => $request->caption,
            'mime_type' => $request->file('file')->getMimeType(),
        ]);

        return back()->with('success', 'Media berhasil diupload.');
    }
}
