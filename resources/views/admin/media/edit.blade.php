@extends('layouts.admin.app')

@section('title', 'Edit Media')

@section('content_header')
    <h1>Edit Media</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('media.update', $media->media_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Referensi Tabel</label>
                <input type="text" name="ref_table" class="form-control" value="{{ $media->ref_table }}" required>
            </div>

            <div class="mb-3">
                <label>ID Referensi</label>
                <input type="number" name="ref_id" class="form-control" value="{{ $media->ref_id }}" required>
            </div>

            <div class="mb-3">
                <label>File Lama</label><br>
                <a href="{{ asset($media->file_url) }}" target="_blank">
                    {{ basename($media->file_url) }}
                </a>
            </div>

            <div class="mb-3">
                <label>Ganti File (Opsional)</label>
                <input type="file" name="file" class="form-control">
            </div>

            <div class="mb-3">
                <label>Caption</label>
                <input type="text" name="caption" class="form-control" value="{{ $media->caption }}">
            </div>

            <div class="mb-3">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ $media->sort_order }}">
            </div>

            <button class="btn btn-success">
                <i class="fa fa-save"></i> Update
            </button>
            <a href="{{ route('media.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </form>

    </div>
</div>
@stop
