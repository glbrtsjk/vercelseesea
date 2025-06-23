<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'isi_komentar',
        'tgl_komentar',
        'user_id',
        'article_id'
    ];

    protected $casts = [
        'tgl_komentar' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }

    public function replies()
    {
        return $this->hasMany(CommentReply::class, 'comment_id', 'comment_id');
    }


    public function likeDislikes()
    {
        return $this->morphMany(LikeDislike::class, 'likeable');
    }


    public function getLikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'like')->count();
    }


    public function getDislikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'dislike')->count();
    }


    public function isLikedBy($userId)
    {
        return $this->likeDislikes()
            ->where('user_id', $userId)
            ->where('type', 'like')
            ->exists();
    }

    
    public function isDislikedBy($userId)
    {
        return $this->likeDislikes()
            ->where('user_id', $userId)
            ->where('type', 'dislike')
            ->exists();
    }
}
