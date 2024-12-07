<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'nim',
        'prodi_id',
    ];

    public function prodi_pembayaran()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id');
    }

    public function pembayaran_mhs()
    {
        return $this->belongsTo(ModelMahasiswa::class, 'nim');
    }
}
