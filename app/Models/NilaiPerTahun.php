<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiPerTahun extends Model
{
    protected $fillable = [
        "nilai"
    ];

    public $incrementing = false;
    protected $primaryKey = ['nilai', 'tahun', 'indikator_satuan_id'];
    public $timestamps = false;

    /**
     * Get the user that owns the NilaiPerTahun
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class, 'tahun', 'tahun');
    }
}
