<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * INDEX
     */
    public function index(Request $request)
{
    $query = Media::query();

    if ($request->filled('keyword')) {
        $query->where('caption', 'like', '%' . $request->keyword . '%');
    }

    if ($request->filled('ref_table')) {
        $query->where('ref_table', $request->ref_table);
    }

    $media = $query->latest()
                   ->paginate(20)
                   ->withQueryString();

    return view('admin.media.index', compact('media'));
}


    /**
     * CREATE
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'file'      => 'required|file|max:5000',
            'caption'   => 'nullable|string',
        ]);

        $path = $request->file('file')
            ->store('uploads/' . $request->ref_table, 'public');

        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id'    => $request->ref_id,
            'file_url'  => $path,
            'caption'   => $request->caption,
            'mime_type' => $request->file('file')->getMimeType(),
        ]);

        return redirect()
            ->route('media.index')
            ->with('success', 'Media berhasil ditambahkan.');
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.show', compact('media'));
    }

    /**
     * EDIT (INI YANG ERROR KEMARIN)
     */
    public function edit($id)
    {
        $media = Media::findOrFail($id);
        return view('admin.media.edit', compact('media'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'file'      => 'nullable|file|max:5000',
            'caption'   => 'nullable|string',
            'sort_order'=> 'nullable|integer',
        ]);

        // Jika upload file baru
        if ($request->hasFile('file')) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }

            $media->file_url = $request->file('file')
                ->store('uploads/' . $request->ref_table, 'public');

            $media->mime_type = $request->file('file')->getMimeType();
        }

        $media->update([
            'ref_table' => $request->ref_table,
            'ref_id'    => $request->ref_id,
            'caption'   => $request->caption,
            'sort_order'=> $request->sort_order,
        ]);

        return redirect()
            ->route('media.index')
            ->with('success', 'Media berhasil diperbarui.');
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus.');
    }
}
