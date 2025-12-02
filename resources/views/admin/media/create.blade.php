@extends('layouts.admin.app')

@section('title', 'Tambah Media')

@section('content_header')
    <h1>Tambah Media</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Referensi Tabel</label>
                <input type="text" name="ref_table" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>ID Referensi</label>
                <input type="number" name="ref_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>File</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Caption</label>
                <input type="text" name="caption" class="form-control">
            </div>

            <div class="mb-3">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>

            <button class="btn btn-success">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="{{ route('media.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </form>

    </div>
</div>
@stop
