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
        'deskripsi_id',
        'deskripsi_en',
        'urutan_animasi',
        'article_id',
        'is_highlighted'  // New field for featured funfacts
    ];

    /**
     * The article that this funfact is related to
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }

    /**
     * Get the description based on current locale
     */
    public function getLocalizedDescription()
    {
        $locale = app()->getLocale();
        return $locale === 'id' ? $this->deskripsi_id : $this->deskripsi_en;
    }

    /**
     * Scope a query to get random funfacts
     */
    public function scopeRandomized($query, $limit = 12)
    {
        return $query->inRandomOrder()->limit($limit);
    }

    /**
     * Scope a query to get latest funfacts
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to filter by article
     */
    public function scopeByArticle($query, $articleId)
    {
        return $query->where('article_id', $articleId);
    }

    /**
     * Scope a query to search by keyword
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('deskripsi_id', 'like', "%{$keyword}%")
              ->orWhere('deskripsi_en', 'like', "%{$keyword}%");
        });
    }
}
