<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeristiwaKematian extends Model
{
    protected $table = 'peristiwa_kematian';
    protected $primaryKey = 'kematian_id';

    protected $fillable = [
        'warga_id',
        'tgl_meninggal',
        'sebab',
        'lokasi',
        'no_surat',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'peristiwa_kematian');
    }
}
