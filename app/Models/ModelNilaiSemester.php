<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNilaiSemester extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'matakuliah_id',
        'aspek_id',
        'nim',
        'nilai',
        'nilai_angka'
    ];

    public function nilai_matakuliah()
    {
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','kode_mk');
    }

    public function nilai_ta()
    {
        return$this->belongsTo(ModelTahunAkademik::class, 'tahun_akademik','kode');
    }

    public function nilai_aspek()
    {
        return $this->belongsTo(ModelAspekPenilaian::class, 'aspek_id','id');
    }

    public function nilai_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'nim','nim');
    }
}
