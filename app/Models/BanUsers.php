<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'user_id',
        'banned_by',
        'banned_at',
        'reason'
    ];

    protected $casts = [
        'banned_at' => 'datetime'
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function bannedBy()
    {
        return $this->belongsTo(User::class, 'banned_by', 'user_id');
    }

    public static function canBan(User $user, Community $community)
    {
        // Get the user's membership in the community
        $membership = $community->users()
            ->where('users.user_id', $user->user_id)
            ->first();

        // Only users with moderator role can ban
        return $membership && $membership->pivot->role === 'moderator';
    }


    public static function banByModerator(Community $community, User $targetUser, User $moderator, ?string $reason = null)
    {
        // Check if moderator has permission
        if (!self::canBan($moderator, $community)) {
            return false;
        }

        return self::create([
            'community_id' => $community->community_id,
            'user_id' => $targetUser->user_id,
            'banned_by' => $moderator->user_id,
            'banned_at' => now(),
            'reason' => $reason
        ]);
    }
}
