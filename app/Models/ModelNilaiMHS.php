<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelNilaiMHS extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'matakuliah_id',
        'nim',
        'total_nilai',
        'nilai_angka',
        'nilai_huruf',

    ];

    public function nilai_ta_mhs()
    {
        return$this->belongsTo(ModelTahunAkademik::class, 'tahun_akademik','kode');
    }

    public function nilai_mhs_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'nim','nim');
    }

    public function nilai_matakuliah_mhs()
    {
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','kode_mk');
    }
}
