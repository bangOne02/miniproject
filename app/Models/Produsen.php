<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Produsen extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'produsens';

    protected $fillable = ['code','name','is_active'];

    protected static function booted()
    {
        static::creating(function ($produsen) {
            $produsen->code = Produsen::generateCode();
        });
    }

    public static function generateCode()
    {
        do {
            $code = Str::random(10);
        } while (Produsen::where('code', $code)->exists());

        return $code;
    }


}
