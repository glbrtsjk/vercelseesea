<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';


    protected $primaryKey = 'article_id';


    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_REJECTED = 'rejected';


    protected $fillable = [
        'judul',
        'slug',
        'konten_isi_artikel',
        'gambar',
        'tgl_upload',
        'user_id',
        'category_id',
        'status',
        'is_featured',
        'approved_by',
        'approved_at',
        'rejection_reason'
    ];



    protected $casts = [
        'tgl_upload' => 'date',
        'approved_at' => 'datetime',
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

     public function getStatusColor()
    {
        return match($this->status) {
            'draft' => 'bg-gray-200 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'published' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }


    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            if (Str::startsWith($this->gambar, 'http')) {
                return $this->gambar;
            }
            return asset('storage/' . $this->gambar);
        }
        return null;
    }


    public function getUrlAttribute()
    {
        return route('articles.show', $this->slug);
    }


    public function getExcerptAttribute($length = 200)
    {
        return Str::limit(strip_tags($this->konten_isi_artikel), $length);
    }


    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }


    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

        public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }


    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }


    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'user_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

        public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag_pivot', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }


    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }


    public function likeDislikes()
    {
        return $this->morphMany(LikeDislike::class, 'likeable');
    }


    public function funfacts()
    {
        return $this->hasMany(Funfact::class, 'article_id', 'article_id');
    }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }


    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }


    public function isFeatured()
    {
        return $this->is_featured;
    }


    public function belongsToUser($userId)
    {
        return $this->user_id === $userId;
    }


    public function formattedUploadDate($format = 'j F Y')
    {
        return $this->tgl_upload->translatedFormat($format);
    }


    public function timeAgo()
    {
        return $this->tgl_upload->diffForHumans();
    }


    public function getLikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'like')->count();
    }


    public function getDislikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'dislike')->count();
    }


    public function isApproved()
    {
        return $this->approved_at !== null;
    }
}
