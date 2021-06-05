<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengantar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    function penduduk() {
        return $this->hasMany(\App\Models\DataPenduduk::class, 'nomor_nik', 'nik');
    }
}
