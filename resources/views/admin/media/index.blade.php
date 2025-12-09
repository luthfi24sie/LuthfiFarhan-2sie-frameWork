@extends('layouts.admin.app')

@section('title', 'Media')

@section('content_header')
    <h1>Daftar Media</h1>
@stop

@section('content')
<div class="card">

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tabel Referensi</th>
                    <th>ID Referensi</th>
                    <th>File</th>
                    <th>Caption</th>
                    <th>Tipe</th>
                    <th>#</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($media as $m)
                <tr>
                    <td>{{ $m->media_id }}</td>
                    <td>{{ $m->ref_table }}</td>
                    <td>{{ $m->ref_id }}</td>

                    <td>
                        <a href="{{ asset('storage/' . $m->file_url) }}" target="_blank">
                            {{ basename($m->file_url) }}
                        </a>
                    </td>

                    <td>{{ $m->caption }}</td>
                    <td>{{ $m->mime_type }}</td>

                    <td>
                        <form action="{{ route('media.destroy', $m->media_id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop
