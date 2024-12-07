<?php

namespace App\Models;

use App\Http\Controllers\KelasMahasiswaController;
use App\Models\ModelDosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ModelMatakuliah;
use App\Models\ModelRuangan;

class ModelProdi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang',
        'ka_prodi',

    ];


    public function dosen()
    {
        return $this->belongsTo(ModelDosen::class, 'ka_prodi');
    }

    public function matakuliah()
    {
        return $this->hasMany(ModelMatakuliah::class);
    }

    public function ruangan()
    {
        return $this->hasMany(ModelRuangan::class);
    }

    public function kelas()
    {
        return $this->hasMany(ModelKelas::class);
    }

    public function betas_sks()
    {
        return $this->hasMany(ModelBatasSKS::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(ModelMahasiswa::class);
    }

    public function kelas_mhs()
    {
        return $this->hasMany(ModelKelasMahasiswa::class);
    }

    public function prodi_pembayaran()
    {
        return $this->hasMany(ModelPembayaran::class,'prodi_id','kode_prodi');
    }
}
