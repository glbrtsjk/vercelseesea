<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'tag_id';
    protected $fillable = ['nama_tag', 'slug', 'deskripsi'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->nama_tag);
            }
        });
    }


    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag_pivot', 'tag_id', 'article_id');
    }

        public function users()
    {
        return $this->belongsToMany(User::class, 'user_tag_pivot', 'tag_id', 'user_id');
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
