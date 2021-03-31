<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPerTahun extends Model
{
    protected $fillable = [
        "tahun",
        "nilai",
    ];

    public $timestamps = false;
}
