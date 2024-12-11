<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDetailJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'matakuliah_id',
        'nidn',
        'kelas_id',
        'ruangan_id',
        'hari',
        'jam',

    ];

    public function jadwal(){
        return $this->belongsTo(ModelJadwal::class,'jadwal_id','id');
    }

    public function jadwal_matakuliah(){
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','kode_mk');
    }

    public function jadwal_dosen(){
        return $this->belongsTo(ModelDosen::class,'nidn','nidn');
    }

    public function jadwal_kelas(){
        return $this->belongsTo(ModelKelas::class,'kelas_id','id');
    }

    public function jadwal_ruangan(){
        return $this->belongsTo(ModelRuangan::class,'ruangan_id','id');
    }


}



