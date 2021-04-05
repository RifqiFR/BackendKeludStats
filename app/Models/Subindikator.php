<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subindikator extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_subindikator"
    ];

    public $timestamps = false;

    public function indikatorSatuans(): HasMany
    {
        return $this->hasMany(IndikatorSatuan::class);
    }
}
