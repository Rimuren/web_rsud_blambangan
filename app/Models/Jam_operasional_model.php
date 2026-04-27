<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam_operasional_model extends Model
{
    use HasFactory;

    protected $table = 'jam_operasionals';

    protected $fillable = [
        'hari',
        'jam_buka',
        'jam_tutup',
        'is_closed',
    ];

    protected $casts = [
        'hari' => 'integer',
        'is_closed' => 'boolean',
    ];

    public const HARI_OPTIONS = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];

    public function getHariLabelAttribute(): string
    {
        return self::HARI_OPTIONS[$this->hari] ?? 'Tidak diketahui';
    }

    public function getJamOperasionalAttribute(): string
    {
        if ($this->is_closed) {
            return 'Tutup';
        }

        if (!$this->jam_buka || !$this->jam_tutup) {
            return '-';
        }

        return substr($this->jam_buka, 0, 5) . ' - ' . substr($this->jam_tutup, 0, 5);
    }
}
