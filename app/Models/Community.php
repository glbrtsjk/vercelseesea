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
        'gambar',
        'created_by',
        'is_active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_user_pivots', 'community_id', 'user_id')
                ->withPivot('tg_gabung', 'role')
                ->withTimestamps()
                ->using(CommunityMember::class);
    }

     public function initiatives()
   {
    return $this->hasMany(CommunityInitiative::class, 'community_id', 'community_id')
        ->orderBy('urutan_prioritas', 'asc');
   }

    public function messages()
    {
        return $this->hasMany(Message::class, 'community_id', 'community_id');
    }


    public function lock()
    {
        return $this->hasOne(CommunityLock::class, 'community_id', 'community_id');
    }


    public function isLocked()
    {
        return $this->lock()->exists();
    }


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

    public function events()
{
    return $this->hasMany(CommunityEvent::class, 'community_id', 'community_id');
}
}
