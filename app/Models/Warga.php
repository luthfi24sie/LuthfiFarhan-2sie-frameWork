<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'pendidikan_terakhir',
        'pekerjaan',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'status_kependudukan',
        'kewarganegaraan',
        'telp',
        'email',
    ];

    public function kepalaKeluarga()
    {
        return $this->hasOne(Keluarga_KK::class, 'kepala_keluarga_warga_id');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class, 'warga_id');
    }

    public function kelahiran()
    {
        return $this->hasOne(PeristiwaKelahiran::class, 'warga_id');
    }

    public function kematian()
    {
        return $this->hasOne(PeristiwaKematian::class, 'warga_id');
    }

    public function pindah()
    {
        return $this->hasOne(PeristiwaPindah::class, 'warga_id');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'ref', 'ref_table', 'ref_id');
    }
}
