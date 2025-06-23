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
        'tgl_pesan',
        'user_id',
        'community_id',
        'lampiran',
        'lampiran_nama',
        'lampiran_tipe',
    ];

    protected $casts = [
        'tgl_pesan' => 'datetime',
    ];

    public function setKontenAttribute($value)
    {
        $this->attributes['isi_pesan'] = $value;
    }

    // Add an accessor to get konten from isi_pesan
    public function getKontenAttribute()
    {
        return $this->attributes['isi_pesan'];
    }

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


