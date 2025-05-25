<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Article Resource
 */
class ArticleResource extends JsonResource
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
            'konten_isi_artikel' => $this->konten_isi_artikel,
            'gambar' => $this->gambar ? Storage::url($this->gambar) : null,
            'status' => $this->status,
            'tgl_upload' => $this->tgl_upload->format('M d, Y'),
            'approved_at' => $this->approved_at ? $this->approved_at->format('M d, Y') : null,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'links' => [
                'show' => route('admin.articles.show', $this->id),
                'approve' => route('admin.articles.approve', $this->id),
                'destroy' => route('admin.articles.destroy', $this->id),
            ],
        ];
    }
}
