<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuteUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'user_id',
        'muted_by',
        'muted_at',
        'unmute_at'
    ];

    protected $casts = [
        'muted_at' => 'datetime',
        'unmute_at' => 'datetime'
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function mutedBy()
    {
        return $this->belongsTo(User::class, 'muted_by', 'user_id');
    }

    public static function canMute(User $user, Community $community)
    {
        // Get the user's membership in the community
        $membership = $community->users()
            ->where('users.user_id', $user->user_id)
            ->first();

        // Only users with moderator role can mute
        return $membership && $membership->pivot->role === 'moderator';
    }


    public static function muteByModerator(Community $community, User $targetUser, User $moderator, int $minutes)
    {
        // Check if moderator has permission
        if (!self::canMute($moderator, $community)) {
            return false;
        }

        return self::create([
            'community_id' => $community->community_id,
            'user_id' => $targetUser->user_id,
            'muted_by' => $moderator->user_id,
            'muted_at' => now(),
            'unmute_at' => now()->addMinutes($minutes)
        ]);
    }
}
