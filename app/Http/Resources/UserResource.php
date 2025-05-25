<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'foto_profil' => $this->foto_profil ? Storage::url($this->foto_profil) : null,
            'created_at' => $this->created_at->format('M d, Y'),
            'articles_count' => $this->when(isset($this->articles_count), $this->articles_count),
            'links' => [
                'show' => route('admin.users.show', $this->id),
            ],
        ];
    }
}
