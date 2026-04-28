<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'video';

    protected $fillable = [
        'judul',
        'link',
        'youtube_id',
        'thumbnail',
        'deskripsi',
        'kategori',
    ];

    // Embed URL (untuk iframe)
    public function getEmbedUrlAttribute(): string
    {
        return "https://www.youtube.com/embed/{$this->youtube_id}";
    }

    // Thumbnail URL (fallback aman)
    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
            ?: "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
    }
}
