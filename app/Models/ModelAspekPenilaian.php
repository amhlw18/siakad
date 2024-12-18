<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAspekPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'matakuliah_id',
        'nidn',
        'nama_dosen',
        'aspek',
        'bobot',
    ];

    public function aspek_penilaian()
    {
        return $this->belongsTo(ModelMatakuliah::class,'matakuliah_id','id');
    }
}
