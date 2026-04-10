<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artikel_model extends Model
{
    protected $table = 'artikel';

    protected $fillable = [
        '',
    ];

    public function kategori_artikel()
    {
        return $this->belongsTo(kategori_artikel_model::class);
    }
}
