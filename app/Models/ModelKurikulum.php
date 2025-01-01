<?php

namespace App\Models;

use App\Models\ModelMatakuliah;
use App\Models\ModelTahunAkademik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelKurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik_id',
        'kode_kurikulum',
        'nama_kurikulum',
        'sks_wajib',
        'sks_pilihan',
        'jumlah_sks'
    ];


    public function tahun_akademik()
    {
        return $this->belongsTo(ModelTahunAkademik::class, 'tahun_akademik_id','kode');
    }

    public function matakuliah()
    {
        return $this->hasMany(ModelMatakuliah::class,'kurikulum_id','kode_kurikulum');
    }
}
