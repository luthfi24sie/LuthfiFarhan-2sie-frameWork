<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaGuestController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $ref_table = $request->input('ref_table');

        $media = Media::query()
            ->when($q, function ($query) use ($q) {
                $query->where('caption', 'like', "%{$q}%")
                      ->orWhere('file_url', 'like', "%{$q}%");
            })
            ->when($ref_table, function ($query) use ($ref_table) {
                $query->where('ref_table', $ref_table);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get unique ref_tables for the filter dropdown
        $tables = Media::distinct()->pluck('ref_table');

        return view('guest.media.index', compact('media', 'tables', 'q', 'ref_table'));
    }

    public function create()
    {
        return view('guest.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'file' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx', // 5MB
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('file')->store('uploads/media', 'public');

        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'file_url' => $path,
            'caption' => $request->caption,
            'mime_type' => $request->file('file')->getMimeType(),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('guest.media.index')->with('success', 'Media berhasil ditambahkan.');
    }

    public function edit(Media $media)
    {
        return view('guest.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'ref_table' => 'required|string|max:50',
            'ref_id' => 'required|integer',
            'file' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx',
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'caption' => $request->caption,
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }

            $path = $request->file('file')->store('uploads/media', 'public');
            $data['file_url'] = $path;
            $data['mime_type'] = $request->file('file')->getMimeType();
        }

        $media->update($data);

        return redirect()->route('guest.media.index')->with('success', 'Media berhasil diperbarui.');
    }

    public function destroy(Media $media)
    {
        if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }
        
        $media->delete();

        return redirect()->route('guest.media.index')->with('success', 'Media berhasil dihapus.');
    }
}
