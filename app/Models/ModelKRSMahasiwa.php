<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKRSMahasiwa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'prodi_id',
        'matakuliah_id',
        'nim',
    ];

    public  function krs_tahun_akadmeik()
    {
        return $this->belongsTo(ModelTahunAkademik::class,'tahun_akademik','kode');
    }

    public  function krs_prodi()
    {
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }

    public  function krs_matkul()
    {
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','kode_mk');
    }

    public  function krs_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class,'nim','nim');
    }

    public  function pa_krs()
    {
        return $this->hasMany(ModelPAMahasiswa::class,'krs_mhs','nim');
    }
}
