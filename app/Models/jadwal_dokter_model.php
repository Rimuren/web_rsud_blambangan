<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class jadwal_dokter_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_dokter';

    protected $fillable = [
        'api_id',
        'dokter_id',
        'poliklinik_id',
        'ruangan_id',
        'ruangan_nama',
        'kode_jadwal',
        'hari',
        'hari_order',
        'jam_mulai',
        'jam_selesai',
        'tipe_pelayanan',
        'is_manual',
        'is_active'
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'is_manual' => 'boolean',
        'is_active' => 'boolean',
    ];

    // ================= RELATION =================
    public function dokter()
    {
        return $this->belongsTo(dokter_model::class, 'dokter_id');
    }

    public function poliklinik()
    {
        return $this->belongsTo(poliklinik_model::class, 'poliklinik_id');
    }

    // ================= SCOPES =================
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeManual($query)
    {
        return $query->where('is_manual', true);
    }

    public function scopeFromApi($query)
    {
        return $query->where('is_manual', false);
    }

    // ================= HELPER =================
    public function getIsTodayAttribute()
    {
        $today = Carbon::now('Asia/Jakarta')->translatedFormat('l');
        return $this->hari === $today;
    }

    public function getIsOpenAttribute()
    {
        if (!$this->is_today) return false;

        $now = Carbon::now('Asia/Jakarta');
        $start = Carbon::parse($this->jam_mulai);
        $end = Carbon::parse($this->jam_selesai);

        return $now->between($start, $end);
    }
}
