<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'article_id';


protected $fillable = [
    'judul',
    'slug',
    'konten_isi_artikel',
    'gambar',
    'status',
    'is_featured',
    'tgl_upload',
    'approved_by',
    'approved_at',
    'rejection_reason',
    'user_id',
    'category_id',
];

    protected $casts = [
        'tgl_upload' => 'date',
        'approved_at' => 'date'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';


    public function approve($approverId = null)
    {
        $this->status = self::STATUS_PUBLISHED;
        $this->approved_by = $approverId;
        $this->approved_at = now();
        $this->save();

        return $this;
    }

    /**
     * Reject the article
     *
     * @param string|null $reason Reason for rejection
     * @return $this
     */
    public function reject($reason = null)
    {
        $this->status = self::STATUS_REJECTED;
        $this->rejection_reason = $reason;
        $this->save();

        return $this;
    }


    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

     public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    /**
     * Scope for rejected articles
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }

    public function funfacts()
    {
        return $this->hasMany(Funfact::class, 'article_id', 'article_id');
    }

    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag_pivots', 'article_id', 'tag_id')
                ->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
