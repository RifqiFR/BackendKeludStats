<?php

namespace App\Http\Resources;

use App\Models\Infografi;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class InfografiResources extends JsonResource
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
            'id' => $this->id,
            'judul' => $this->judul,
            'gambar' => URL::to("storage" . "/" . Infografi::$FOLDER_NAME . "/" . $this->gambar),
            'caption' => $this->caption,
            'date' => $this->date,
        ];
    }
}
