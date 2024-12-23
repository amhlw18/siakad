<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPAMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nim',
        'nidn',
    ];

    public  function pa_prodi()
    {
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }

    public  function pa_dosen()
    {
        return $this->belongsTo(ModelDosen::class,'nidn','nidn');
    }

    public  function pa_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class,'nim','nim');
    }

    public  function pa_krs()
    {
        return $this->belongsTo(ModelMahasiswa::class,'krs_mhs','nim');
    }

}
