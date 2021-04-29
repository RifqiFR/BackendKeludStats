<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        "tahun"
    ];

    protected $primaryKey = 'tahun';

    public $incrementing = false;
    public $timestamps = false;
}
