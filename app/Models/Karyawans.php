<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawans extends Model
{

    use SoftDeletes;

    protected $table = "karyawans";

    protected $fillable = ["user_id","nip","alamat","phone","sex","tanggal_bergabung","status"];

    public function dokter()
    {
        return $this->hasOne(Dokter::class,'karyawan_id','id')->with('poli');
    }
}
