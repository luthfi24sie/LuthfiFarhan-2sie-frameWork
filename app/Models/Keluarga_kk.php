<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga_kk extends Model
{
    protected $table = 'keluarga_kk';
    protected $primaryKey = 'kk_id';

    protected $fillable = [
        'kk_nomor',
        'kepala_keluarga_warga_id',
        'alamat',
        'rt',
        'rw',
    ];

    // KEPALA KELUARGA
    public function kepalaKeluarga()
    {
        return $this->belongsTo(Warga::class, 'kepala_keluarga_warga_id');
    }

    // ANGGOTA KELUARGA
    public function anggota()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'kk_id', 'kk_id');
    }

    // FILTER
    public function scopeFilter($query, $request, $filterable)
    {
        foreach ($filterable as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->$column);
            }
        }
        return $query;
    }

    // SEARCH
    public function scopeSearch($query, $request, $columns)
    {
        if ($request->filled('search')) {
            $q = $request->search;

            $query->where(function ($x) use ($columns, $q) {
                foreach ($columns as $col) {
                    $x->orWhere($col, 'LIKE', "%$q%");
                }
            });
        }
        return $query;
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'ref', 'ref_table', 'ref_id');
    }
}
