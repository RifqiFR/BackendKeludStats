<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indikator extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_indikator"
    ];

    public $timestamps=false;

    public function subindikators(): HasMany
    {
        return $this->hasMany(Subindikator::class);
    }
}