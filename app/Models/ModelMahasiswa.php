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
        $tahunSekarang = Carbon::now()->year;
        $tahunAngkatan = $this->tahun_masuk; // Kolom tahun angkatan
        $bulanSekarang = Carbon::now()->month;

        // Hitung selisih tahun
        $jarakTahun = $tahunSekarang - $tahunAngkatan;

        // Tentukan semester (1 = ganjil, 2 = genap)
        $semesterBerjalan = ($bulanSekarang >= 1 && $bulanSekarang <= 6) ? 2 : 1;

        // Hitung semester saat ini
        return ($jarakTahun * 2) + $semesterBerjalan;
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

}
