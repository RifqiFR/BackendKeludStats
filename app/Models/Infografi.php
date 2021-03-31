<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografi extends Model
{
    public static $FOLDER_NAME = 'infografi';

    use HasFactory;

    protected $fillable = [
        "judul",
        "caption",
    ];

    public $timestamps = false;
}
