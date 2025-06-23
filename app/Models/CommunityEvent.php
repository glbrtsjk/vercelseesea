<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityEvent extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'community_id',
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'image',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }
}
