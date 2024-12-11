<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nama_kelas',
        'program',
        'kapasitas',
    ];

    public function prodi_kelas()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id','kode_prodi');
    }

    public function kelas_mahasiswa(){
        return $this->hasMany(ModelKelasMahasiswa::class, 'kelas_id','id');
    }

    public function jadwal_kelas(){
        return $this->hasMany(ModelDetailJadwal::class,'kelas_id','id');
    }
}
