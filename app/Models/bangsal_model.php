<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bangsal_model extends Model
{
    protected $table = 'bangsal';

    protected $fillable = [
        'api_id',        // ID dari API (wajib untuk sinkronasi)
        'nama',
        'deskripsi',
        'foto',
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
            'bangsal_id',
            'kelas_id'
        )->withPivot('bed_kapasitas', 'bed_terisi', 'bed_kosong')
            ->withTimestamps();
    }

    // akses pivot sebagai model (opsional, berguna untuk agregasi)
    public function bangsalKelas()
    {
        return $this->hasMany(bangsal_kelas_model::class, 'bangsal_id');
    }

    // =========================
    // HELPER (opsional)
    // =========================

    public function getTotalKapasitasAttribute()
    {
        return $this->bangsalKelas->sum('bed_kapasitas');
    }

    public function getTotalTerisiAttribute()
    {
        return $this->bangsalKelas->sum('bed_terisi');
    }

    public function getTotalKosongAttribute()
    {
        return $this->bangsalKelas->sum('bed_kosong');
    }
}
