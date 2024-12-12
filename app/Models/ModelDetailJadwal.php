<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDetailJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'tahun_akademik',
        'matakuliah_id',
        'nidn',
        'kelas_id',
        'ruangan_id',
        'hari',
        'jam',

    ];



    public function prodi_jadwal(){
        return $this->belongsTo(ModelProdi::class,'prodi_id','kode_prodi');
    }

    public function tahun_jadwal(){
        return $this->belongsTo(ModelTahunAkademik::class,'tahun_akademik','id');
    }

    public function jadwal_matakuliah(){
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','id');
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



