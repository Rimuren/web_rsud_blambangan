<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jadwal_dokter_model;

class dokter_model extends Model
{

    use HasFactory;

    protected $table = 'dokter';
    protected $fillable = [
        'nama', 
        'kode',
        'kode_bpjs', 
        'spesialis', 
        'subspesialis',
        'pendidikan', 
        'umur', 
        'rating', 
        'image_path'
    ];
    public function jadwal_dokter()
    {
        return $this->hasMany(jadwal_dokter_model::class, 'dokter_id');
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image_path)) {
            return null;
        }

        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        $baseUrl = config('api.rsud.base_url');
        $baseUrlForImage = str_replace('/api/online', '', $baseUrl);
        return rtrim($baseUrlForImage, '/') . '/' . ltrim($this->image_path, '/');
    }
}
