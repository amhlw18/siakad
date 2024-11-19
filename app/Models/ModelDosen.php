<?php

namespace App\Models;

use App\Models\ModelProdi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelDosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nidn',
        'nama_dosen',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'email',
        'alamat',
        'tgl_kerja',
        'ikatan_kerja',
        'pendidikan',
        'status',
        'jabatan_akademik',
        'jabatan_struktural',
        'golongan',
    ];

    public function prodi()
    {
        return $this->hasMany(ModelProdi::class);
    }
}
