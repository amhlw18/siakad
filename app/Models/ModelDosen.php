<?php

namespace App\Models;

use App\Models\ModelProdi;
use App\Models\ModelDetailJadwal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelDosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nidn',
        'prodi_id',
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

//    public function getTglLahirAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d') : null;
//    }

    public function prodi()
    {
        return $this->hasMany(ModelProdi::class,'ka_prodi','nidn');
    }

    public function dosen(){
        return $this->hasMany(ModelDetailJadwal::class,'nidn','nidn');
    }

    public  function pa_dosen()
    {
        return $this->hasMany(ModelPAMahasiswa::class,'nidn','nidn');
    }

    public function dosen_homebase()
    {
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }
}
