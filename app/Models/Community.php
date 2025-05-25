<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $primaryKey = 'community_id';

    protected $fillable = [
        'nama_komunitas',
        'slug',
        'deskripsi',
        'gambar'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user_pivots', 'community_id', 'user_id')
                ->withPivot('tg_gabung', 'role')
                ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'community_id', 'community_id');
    }

    /**
     * Get the lock record for this community if it exists
     */
    public function lock()
    {
        return $this->hasOne(CommunityLock::class, 'community_id', 'community_id');
    }

    /**
     * Check if community chat is locked
     */
    public function isLocked()
    {
        return $this->lock()->exists();
    }

    /**
     * Get banned users for this community
     */
    public function bannedUsers()
    {
        return $this->hasMany(BannedUser::class, 'community_id', 'community_id');
    }

    public function getLockInfo()
{
    return CommunityLock::where('community_id', $this->community_id)
        ->with('lockedBy')
        ->first();
}
    public function mutedUsers()
    {
        return $this->hasMany(MutedUser::class, 'community_id', 'community_id')
            ->where('unmute_at', '>', now());
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
