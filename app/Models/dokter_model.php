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
        'rating',
        'image_path',
    ];

    protected $casts = [
        'umur' => 'integer',
        'rating' => 'float',
    ];
}
