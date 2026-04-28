<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dokter_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dokter';

    protected $fillable = [
        'api_id',
        'nama',
        'kode',
        'kode_bpjs',
        'spesialis',
        'subspesialis',
        'pendidikan',
        'umur',
        'rating',
        'image_path',
        'is_manual',
        'is_active'
    ];

    protected $casts = [
        'is_manual' => 'boolean',
        'is_active' => 'boolean',
    ];

    // ================= RELATION =================
    public function jadwal_dokter()
    {
        return $this->hasMany(jadwal_dokter_model::class, 'dokter_id');
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

    // ================= ACCESSOR =================
    public function getImageUrlAttribute()
    {
        if (!empty($this->image_path)) {
            if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
                return $this->image_path;
            }
            $baseUrl = config('api.rsud.base_url');
            $baseImageUrl = str_replace('/api/online', '', rtrim($baseUrl, '/'));
            return $baseImageUrl . '/' . ltrim($this->image_path, '/');
        }
        return 'https://ui-avatars.com/api/?background=003366&color=fff&name=' . urlencode($this->nama) . '&size=128';
    }
}
