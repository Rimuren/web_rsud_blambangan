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
        'slug',
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
        'minggu',
        'is_active'
    ];

    protected $casts = [
        'senin' => 'boolean',
        'selasa' => 'boolean',
        'rabu' => 'boolean',
        'kamis' => 'boolean',
        'jumat' => 'boolean',
        'sabtu' => 'boolean',
        'minggu' => 'boolean',
        'is_active' => 'boolean',
    ];

    // ================= RELATION =================
    public function jadwal_dokter()
    {
        return $this->hasMany(jadwal_dokter_model::class, 'poliklinik_id');
    }

    // relasi tidak langsung
    public function dokters()
    {
        return $this->hasManyThrough(
            dokter_model::class,
            jadwal_dokter_model::class,
            'poliklinik_id',
            'id',
            'id',
            'dokter_id'
        );
    }
}
