<?php

namespace App\Models;

use App\Models\ModelKurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelMatakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kurikulum_id',
        'kode_prodi',
        'kode_mk',
        'nama_mk',
        'semester',
        'sks_teori',
        'sks_praktek',
        'sks_lapangan',
        'kelompok_mk',
        'jenis_kelompok',
        'jenis_mk',
        'status_mk',
        'silabus_mk',
        'sap_mk',
        'bahan_ajar',
        'diktat',
    ];


    public function kurikulum()
    {
        return $this->belongsTo(ModelKurikulum::class, 'kurikulum_id');
    }

    public function prodi()
    {
        return $this->belongsTo(ModelProdi::class, 'kode_prodi');
    }
}
