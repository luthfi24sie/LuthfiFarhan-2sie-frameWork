<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'warga';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];
}
