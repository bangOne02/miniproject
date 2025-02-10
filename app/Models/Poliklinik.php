<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poliklinik extends Model
{

    use SoftDeletes;

    protected $table = "polikliniks";

    protected $fillable = ["name"];

    public function dokter(){
        return $this->belongsTo(Dokter::class,'id','poliklinik_id');
    }

}
