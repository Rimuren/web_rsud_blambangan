<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\dokter_model;

class jadwal_dokter_model extends Model
{
    
    use HasFactory;

    protected $table= 'jadwal_dokter';

    protected $fillable = [
        'dokter_id',
        'poliklinik_id',
        'ruangan_id',
        'kode_jadwal',
        'hari',
        'hari_order',
        'jam_mulai',
        'jam_selesai',
        'tipe_pelayanan'
    ];
    public function dokter()
    {
        return $this->belongsTo(dokter_model::class);
    }
}
