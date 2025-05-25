<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Get the parent likeable model.
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user who created the like/dislike.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
