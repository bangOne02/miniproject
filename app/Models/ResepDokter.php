<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepDokter extends Model
{
    use HasFactory;

    protected $table = 'resep_dokter';

    protected $fillable = [
        'rekam_id', 
        'obat_id', 
        'jumlah', 
        'dosis', 
        'aturan_pakai',
        'status'
    ];

    // Relasi ke Rekam
    public function rekam()
    {
        return $this->belongsTo(Rekam::class, 'rekam_id');
    }

    // Relasi ke Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
