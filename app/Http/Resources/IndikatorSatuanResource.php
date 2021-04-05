<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndikatorSatuanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nama_tabel_indikator" => $this->nama_tabel_indikator,
            "satuan" => $this->satuan,
            "nilai_per_tahun" => $this->nilaiPerTahuns
        ];
    }
}
