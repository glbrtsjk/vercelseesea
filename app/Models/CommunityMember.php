<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CommunityMember extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'community_user_pivots';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'community_id',
        'tg_gabung',
        'role' 
    ];


    protected $casts = [
        'tg_gabung' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }
}
