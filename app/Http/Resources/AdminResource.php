<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\FunfactResource;
use App\Http\Resources\TagResource;

class AdminDashboardResource extends JsonResource
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
            'stats' => [
                'total_articles' => $this['totalArticles'],
                'pending_articles' => $this['pendingArticles'],
                'total_users' => $this['totalUsers'],
                'total_communities' => $this['totalCommunities'],
            ],
            'recent_articles' => ArticleResource::collection($this['recentArticles']),
            'recent_funfacts' => FunfactResource::collection($this['recentFunfacts']),
            'popular_tags' => TagResource::collection($this['popularTags']),
            'recent_users' => UserResource::collection($this['recentUsers']),
        ];
    }
}
