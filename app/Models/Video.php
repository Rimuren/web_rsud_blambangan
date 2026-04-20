<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'link',
        'youtube_id',
        'thumbnail',
        'deskripsi',
        'kategori',
    ];

    // Helper untuk mendapatkan embed URL
    public function getEmbedUrlAttribute()
    {
        return 'https://www.youtube.com/embed/' . $this->youtube_id;
    }
}