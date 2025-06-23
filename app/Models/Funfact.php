<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funfact extends Model
{
    use HasFactory;

    protected $primaryKey = 'funfact_id';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'urutan_animasi',
        'article_id',
        'is_highlighted'
    ];


    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }


    public function getLocalizedDescription()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->deskripsi_id : $this->deskripsi_en;
    }


    public function scopeRandomized($query, $limit = 12)
    {
        return $query->inRandomOrder()->limit($limit);
    }


    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

        public function scopeByArticle($query, $articleId)
    {
        return $query->where('article_id', $articleId);
    }

   
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('deskripsi_id', 'like', "%{$keyword}%")
              ->orWhere('deskripsi_en', 'like', "%{$keyword}%");
        });
    }
}
