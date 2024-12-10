<?php

namespace App\Models;

use App\Models\ModelKurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelTahunAkademik extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'tahun_akademik',
        'semester',
        'periode_pembayaran',
        'periode_perkuliahan',
        'periode_krs',
        'periode_penilaian',
        'periode_uts',
        'periode_uas',
    ];

    public function kurikulum()
    {
        return $this->hasMany(ModelKurikulum::class);
    }

    public  function pembayaran_tahun_akademik()
    {
        return $this->hasMany(ModelPembayaran::class, 'tahun_akademik','id');
    }

    public function smt_masuk(){
        return $this->hasMany(ModelMahasiswa::class,'semester_masuk','id');
    }
}
