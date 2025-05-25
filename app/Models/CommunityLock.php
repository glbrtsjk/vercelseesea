<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLock extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'locked_by',
        'locked_at',
        'reason',
    ];

    protected $casts = [
        'locked_at' => 'datetime',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }

    public function lockedBy()
    {
        return $this->belongsTo(User::class, 'locked_by', 'user_id');
    }


    public static function canLock(User $user, Community $community)
    {
        // Get the user's membership in the community
        $member = $community->users()
            ->where('users.user_id', $user->user_id)
            ->first();

        // Only users with moderator role can lock/unlock
        return $member && $member->pivot->role === 'moderator';
    }
}
