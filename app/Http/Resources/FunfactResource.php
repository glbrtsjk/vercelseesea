<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FunfactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'deskripsi_id' => $this->deskripsi_id,
            'deskripsi_en' => $this->deskripsi_en,
            'gambar' => $this->gambar ? Storage::url($this->gambar) : null,
            'links' => [
                'edit' => route('admin.funfacts.edit', $this->id),
            ],
        ];
    }
}

