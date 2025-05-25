<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $primaryKey = 'reply_id';

    protected $fillable = [
        'konten',
        'user_id',
        'comment_id',
        'tgl_reply'
    ];

    protected $casts = [
        'tgl_reply' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'comment_id');
    }

    /**
     * Get all likes/dislikes for this reply
     */
    public function likeDislikes()
    {
        return $this->morphMany(LikeDislike::class, 'likeable');
    }

    /**
     * Get count of likes for this reply
     */
    public function getLikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'like')->count();
    }

    /**
     * Get count of dislikes for this reply
     */
    public function getDislikesCountAttribute()
    {
        return $this->likeDislikes()->where('type', 'dislike')->count();
    }

    /**
     * Check if a specific user has liked this reply
     */
    public function isLikedBy($userId)
    {
        return $this->likeDislikes()
            ->where('user_id', $userId)
            ->where('type', 'like')
            ->exists();
    }

    /**
     * Check if a specific user has disliked this reply
     */
    public function isDislikedBy($userId)
    {
        return $this->likeDislikes()
            ->where('user_id', $userId)
            ->where('type', 'dislike')
            ->exists();
    }
}
