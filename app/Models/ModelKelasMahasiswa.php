<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKelasMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'kelas_id',
        'nim',
    ];

    public function prodi_kelas_mhs()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id','kode_prodi');
    }

    public function mhs_kelas_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'nim','nim');
    }

    public function kelas_mahasiswa(){
        return $this->belongsTo(ModelKelas::class, 'kelas_id','id');
    }

}
