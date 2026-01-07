<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WargaApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // 1. Validate Request
        $validator = Validator::make($request->all(), [
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Use transaction to ensure data integrity
        try {
            DB::beginTransaction();

            // 2. Create Warga Record
            // Exclude profile_photo from the payload as it's not a column in warga table
            $wargaData = $validator->safe()->except(['profile_photo']);
            $warga = Warga::create($wargaData);

            // 3. Handle Profile Photo Upload
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                
                // Store file in 'storage/app/public/uploads/warga'
                $path = $file->store('uploads/warga', 'public');

                // Save to Media table
                Media::create([
                    'ref_table' => 'warga',
                    'ref_id' => $warga->warga_id,
                    'file_url' => $path, // Relative path for storage link
                    'caption' => 'Foto Profil',
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => 0,
                ]);
            }

            DB::commit();

            // Reload media relationship for response
            $warga->load('media');

            return response()->json([
                'success' => true,
                'message' => 'Warga created successfully',
                'data' => $warga
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create warga',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
