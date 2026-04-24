<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bangsal_model extends Model
{
    protected $table = 'bangsal';

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'total_kapasitas_bed',
    ];

    // =========================
    // RELATION
    // =========================

    // many-to-many ke kelas
    public function kelas()
    {
        return $this->belongsToMany(
            kelas_model::class,
            'bangsal_kelas',
            'bangsal_id', // FK ke bangsal
            'kelas_id'    // FK ke kelas
        )->withPivot([
            'bed_kapasitas',
            'bed_terisi',
            'bed_kosong'
        ])->withTimestamps();
    }

    // akses pivot sebagai model
    public function bangsalKelas()
    {
        return $this->hasMany(bangsal_kelas_model::class, 'bangsal_id');
    }

    // =========================
    // HELPER (optional tapi berguna)
    // =========================

    public function getTotalKosongAttribute()
    {
        return $this->bangsalKelas->sum('bed_kosong');
    }

    public function getTotalTerisiAttribute()
    {
        return $this->bangsalKelas->sum('bed_terisi');
    }
}
