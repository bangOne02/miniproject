<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekam extends Model
{
    use SoftDeletes;

    protected $table = "rekams";

    protected $fillable = ['dokter_id','kode_rekam',
        'tekanan_darah','rate','suhu_badan',
        'berat_badan','tinggi_badan','keluhan_utama',
        'diagnosis','deskripsi_tindakan','created_by','status'];


    public function scopeToday($query)
    {
        return $query->where('created_at', '>=', Carbon::today());
    }

    public function scopeOngoing($query)
    {

        return $query->whereIn('status',['0','1']);
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class,'rekam_id','id');
    }

    public function pasien(){
        return $this->belongsTo(Pasien::class,'pasien_id','id');
    }

    public function pushStatus(int $status):void{
        $this->update(['status' => $status]);
    }

    public function resepDokters()
    {
        return $this->hasMany(ResepDokter::class, 'rekam_id');
    }

}
