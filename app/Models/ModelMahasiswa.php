<?php

namespace App\Models;

use App\Http\Controllers\KelasMahasiswaController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nim',
        'nama_mhs',
        'tempat_lahir',
        'tgl_lahir',
        'nama_ayah',
        'nama_ibu',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'email',
        'nik',
        'alamat',
        'status_masuk',
        'program',
        'tahun_masuk',
        'semester_masuk',
        'status',

    ];

    public function getSemesterAttribute()
    {
        $tahun_aktif = ModelTahunAkademik::where('status', 1)->first();
        $semester = $tahun_aktif->kode;
        $angkatan = $this->tahun_masuk; // Kolom tahun masuk dalam database


        if ($semester %2 != 0){
            $a = (($semester + 10)-1)/10;
            $b = $a - $angkatan;
            $c = ($b*2)-1;
            //echo "Semester : $c";
        }else{
            $a = (($semester + 10)-2)/10;
            $b = $a - $angkatan;
            $c = $b * 2;
            //echo "Semester : $c";
        }

        return $c; // Mengembalikan hasil semester
    }



    public function prodi_mhs()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id','kode_prodi');
    }

    public function kelas_mhs()
    {
        return $this->hasMany(KelasMahasiswaController::class,'nim','nim');
    }

    public function pembayaran_mhs()
    {
        return $this->hasMany(ModelPembayaran::class,'nim','nim');
    }

    public function smt_masuk(){
        return $this->belongsTo(ModelTahunAkademik::class,'semester_masuk','id');
    }

    public  function krs_mhs()
    {
        return $this->hasMany(ModelKRSMahasiwa::class,'nim','nim');
    }

    public  function pa_mhs()
    {
        return $this->hasMany(ModelPAMahasiswa::class,'nim','nim');
    }

    public function nilai_mhs()
    {
        return $this->hasMany(ModelNilaiSemester::class, 'nim','nim');
    }

    public function nilai_mhs_mhs()
    {
        return $this->hasMany(ModelNilaiMHS::class, 'nim','nim');
    }

    public  function status_krs_mhs()
    {
        return $this->hasMany(ModelStatusKRS::class,'nim','nim');
    }

}
