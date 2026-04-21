<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poliklinik_model extends Model
{
    use HasFactory;
    protected $table = 'poliklinik';
    protected $fillable = [
        'api_id',
        'nama',
        'kode_bpjs',
        'image',
        'background_img',
        'tarif_konsultasi',
        'jumlah_dokter',
        'senin',
        'selasa',
        'rabu',
        'kamis',
        'jumat',
        'sabtu',
        'minggu'
    ];

    public function jadwal_dokter()
    {
        return $this->hasMany(jadwal_dokter_model::class, 'poliklinik_id');
    }
}
