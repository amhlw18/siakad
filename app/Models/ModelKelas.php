<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nama_kelas',
        'program',
        'kapasitas',
    ];

    public function prodi_kelas()
    {
        return $this->belongsTo(ModelKelas::class, 'prodi_id');
    }
}
