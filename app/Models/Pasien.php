<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use SoftDeletes;

    protected $table = "pasiens";
    protected $appends = ['age'];
    protected $fillable = ['kode_pasien','nama_lengkap','tanggal_lahir','tempat_lahir','sex','agama','pendidikan','phone','gol_darah','pekerjaan','alamat'];

    protected function getAgeAttribute(): int
    {
        return Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }

}
