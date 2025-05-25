<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'reaction_id';

    protected $fillable = [
        'jenis_reaksi',
        'user_id',
        'reactionable_id',
        'reactionable_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function reactionable()
    {
        return $this->morphTo();
    }
}
