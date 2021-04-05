<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndikatorSatuan extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_tabel_indikator",
        "satuan",
    ];

    public $timestamps = false;

    public function nilaiPerTahuns(): HasMany
    {
        return $this->hasMany(NilaiPerTahun::class);
    }
}
