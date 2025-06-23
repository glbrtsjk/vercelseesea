<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;

    protected $primaryKey = 'reply_id';

    protected $fillable = [
        'isi_balasan',
        'user_id',
        'comment_id',
        'tgl_balasan',
    ];

    protected $casts = [
        'tgl_balasan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'comment_id');
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
