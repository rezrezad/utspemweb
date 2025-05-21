<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kendaraan',
        'nomor_plat',
        'merk',
        'model',
        'tahun_produksi',
        'warna',
        'jenis',
        'nomor_mesin',
        'nomor_rangka',
        'keterangan',
    ];

    protected $casts = [
        'tahun_produksi' => 'integer',
    ];
}