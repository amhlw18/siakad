<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'tahun_akademik',

    ];




}
