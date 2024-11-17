<?php

namespace App\Models;

use App\Models\ModelProdi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelDosen extends Model
{
    use HasFactory;

    public function prodi()
    {
        return $this->hasMany(ModelProdi::class);
    }
}
