<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bangsal_kelas_model extends Model
{
    protected $table = 'bangsal_kelas';

    public $incrementing = false; // karena composite key
    protected $primaryKey = null;

    protected $fillable = [
        'bangsal_id',
        'kelas_id',
        'bed_kapasitas',
        'bed_terisi',
        'bed_kosong',
    ];

    // =========================
    // RELATION
    // =========================

    public function bangsal()
    {
        return $this->belongsTo(bangsal_model::class, 'bangsal_id');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas_model::class, 'kelas_id');
    }

    // =========================
    // HELPER
    // =========================

    public function getPersentaseTerisiAttribute()
    {
        if ($this->bed_kapasitas == 0) return 0;

        return round(($this->bed_terisi / $this->bed_kapasitas) * 100, 2);
    }
}
