<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas_model extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'api_id',
        'nama',
    ];

    // =========================
    // RELATION
    // =========================

    public function bangsal()
    {
        return $this->belongsToMany(
            bangsal_model::class,
            'bangsal_kelas',
            'kelas_id',
            'bangsal_id'
        )->withPivot('bed_kapasitas', 'bed_terisi', 'bed_kosong')
            ->withTimestamps();
    }

    public function bangsalKelas()
    {
        return $this->hasMany(bangsal_kelas_model::class, 'kelas_id');
    }
}
