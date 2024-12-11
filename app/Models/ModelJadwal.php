<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'tahun_akademik',

    ];

    public function prodi_jadwal(){
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }

    public function tahun_jadwal(){
        return $this->belongsTo(ModelTahunAkademik::class,'tahun_akademik','id');
    }

    public function jadwal(){
        return $this->hasMany(ModelDetailJadwal::class,'jadwal_id','id');
    }
}
