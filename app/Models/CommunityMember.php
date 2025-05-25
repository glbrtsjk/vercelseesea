<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'community_user_pivot';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'community_id',
        'tg_gabung',
        'role' // Based on your Community model, it appears this field exists in the pivot table
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tg_gabung' => 'date',
    ];

    /**
     * Get the user that is a member.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the community to which the user belongs.
     */
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }
}
