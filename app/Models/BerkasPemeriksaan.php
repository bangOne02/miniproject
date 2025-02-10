<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'berkas_pemeriksaan';

    protected $fillable = [
        'rekam_id',
        'file_path',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Rekam::class, 'rekam_id');
    }
}
