<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeristiwaPindah extends Model
{
    protected $table = 'peristiwa_pindah';
    protected $primaryKey = 'pindah_id';

    protected $fillable = [
        'warga_id',
        'tgl_pindah',
        'alamat_tujuan',
        'alasan',
        'no_surat',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'peristiwa_pindah');
    }
}
