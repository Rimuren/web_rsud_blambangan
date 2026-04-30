<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\artikel_model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori_artikel_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_artikel';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi'
    ];

    public function artikels()
    {
        return $this->hasMany(artikel_model::class, 'kategori_id');
    }
}