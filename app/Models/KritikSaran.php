<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    function penduduk() {
        return $this->hasMany(\App\Models\DataPenduduk::class, 'nomor_nik', 'nik');
    }
}
