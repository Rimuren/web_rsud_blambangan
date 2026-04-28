<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class artikel_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'thumbnail',
        'views',
        'kategori_id',
        'penulis_id',
        'status',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
            $count = 1;
            while (static::where('slug', $artikel->slug)->exists()) {
                $artikel->slug = Str::slug($artikel->judul) . '-' . $count++;
            }
        });

        static::updating(function ($artikel) {
            if ($artikel->isDirty('judul')) {
                $artikel->slug = Str::slug($artikel->judul);
                $count = 1;
                while (static::where('slug', $artikel->slug)->where('id', '!=', $artikel->id)->exists()) {
                    $artikel->slug = Str::slug($artikel->judul) . '-' . $count++;
                }
            }
        });
    }

    // Relasi
    public function kategori()
    {
        return $this->belongsTo(kategori_artikel_model::class, 'kategori_id');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    // Scope
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
