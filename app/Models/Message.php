<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'isi_pesan',
        'gambar',
        'tgl_pesan',
        'user_id',
        'community_id'
    ];

    protected $casts = [
        'tgl_pesan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }

    public function taggedUsers()
    {
        return $this->belongsToMany(User::class, 'message_tags', 'message_id', 'user_id')
                ->withTimestamps();
    }
}


