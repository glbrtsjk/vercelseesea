<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_profil',
        'bio',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_banned' => 'boolean',
        'banned_at' => 'datetime',
        'last_active_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'user_id');
    }

    public function commentReplies()
    {
        return $this->hasMany(CommentReply::class, 'user_id', 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'user_id', 'user_id');
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_user_pivots', 'user_id', 'community_id')
                ->withPivot('tg_gabung')
                ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tag_pivots', 'user_id', 'tag_id')
                ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id', 'user_id');
    }

    public function taggedMessages()
    {
        return $this->belongsToMany(Message::class, 'userr_massage_tags', 'user_id', 'message_id');
    }

    /**
     * Check if the user is an administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is banned
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->is_banned;
    }

    /**
     * Get the admin who banned this user
     */
    public function bannedBy()
    {
        return $this->belongsTo(User::class, 'banned_by', 'user_id');
    }

    /**
     * Update user's last active timestamp
     */
    public function updateLastActive()
    {
        $this->last_active_at = now();
        $this->save();
    }
}
