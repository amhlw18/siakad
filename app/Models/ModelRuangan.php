<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelProdi;

class ModelRuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'nama_ruangan',
        'gedung',
        'lantai',
    ];

    public function prodi_ruangan()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id');
    }
}
