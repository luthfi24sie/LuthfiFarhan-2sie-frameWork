<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    protected $table = 'anggota_keluarga';

    protected $primaryKey = 'anggota_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'kk_id',
        'warga_id',
        'hubungan',
    ];

    public function kk()
    {
        return $this->belongsTo(KeluargaKK::class, 'kk_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
