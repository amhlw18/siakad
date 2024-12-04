<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nim',
        'nama_mhs',
        'tempat_lahir',
        'tgl_lahir',
        'nama_ayah',
        'nama_ibu',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'email',
        'nik',
        'alamat',
        'status_masuk',
        'program',
        'tahun_masuk',
        'semester_masuk',
        'status',

    ];

    public function prodi_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'prodi_id');
    }
}