<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image_path',
    ];

    protected $casts = [
        'umur' => 'integer',
    ];

    public function jadwal_dokter()
    {
        return $this->hasMany(jadwal_dokter_model::class, 'dokter_id');
    }
}
