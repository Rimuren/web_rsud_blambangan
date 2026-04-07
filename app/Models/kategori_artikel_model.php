<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\artikel_model;

class kategori_artikel_model extends Model
{
    protected $table = 'kategori_artikel';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi'
    ];

    public function artikel()
    {
        return $this->hasMany(artikel_model::class, 'kategori_id');
    }
}
