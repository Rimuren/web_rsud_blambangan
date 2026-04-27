<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo_model extends Model
{
    use HasFactory;

    protected $table = 'photo';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'kategori',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->gambar
            ? Storage::url($this->gambar)
            : asset('images/placeholder.jpg');
    }
}
