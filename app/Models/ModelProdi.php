<?php

namespace App\Models;

use App\Models\ModelDosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelProdi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang',
        'ka_prodi',
       
    ];


    public function dosen()
    {
        return $this->belongsTo(ModelDosen::class, 'ka_prodi');
    }

    public function matakuliah()
    {
        return $this->hasMany(ModelMatakuliah::class);
    }
}
