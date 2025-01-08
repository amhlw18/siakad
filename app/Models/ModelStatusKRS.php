<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStatusKRS extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'prodi_id',
        'nim',

    ];

    public  function pa_krs()
    {
        return $this->hasMany(ModelPAMahasiswa::class,'nim','nim');
    }

    public  function status_krs_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class,'nim','nim');
    }

    public  function status_krs_prodi()
    {
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }
}
