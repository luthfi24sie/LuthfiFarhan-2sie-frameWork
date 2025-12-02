<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeristiwaKelahiran extends Model
{
    protected $table = 'peristiwa_kelahiran';
    protected $primaryKey = 'kelahiran_id';

    protected $fillable = [
        'warga_id',
        'tgl_lahir',
        'tempat_lahir',
        'ayah_warga_id',
        'ibu_warga_id',
        'no_akta',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function ayah()
    {
        return $this->belongsTo(Warga::class, 'ayah_warga_id');
    }

    public function ibu()
    {
        return $this->belongsTo(Warga::class, 'ibu_warga_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'peristiwa_kelahiran');
    }
}
