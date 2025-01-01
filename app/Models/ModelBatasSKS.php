<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBatasSKS extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'ipk_min',
        'ipk_max',
        'jumlah_sks',
    ];

    public function prodi_batas_sks()
    {
        return $this->belongsTo(ModelProdi::class, 'prodi_id','kode_prodi');
    }
}
