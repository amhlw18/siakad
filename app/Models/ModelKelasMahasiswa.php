<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKelasMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nim',

    ];

    public function prodi_kelas_mhs()
    {
        return $this->belongsTo(ModelKelasMahasiswa::class, 'prodi_id');
    }

    public function mhs_kelas_mhs()
    {
        return $this->belongsTo(ModelKelasMahasiswa::class, 'nim');
    }
}
