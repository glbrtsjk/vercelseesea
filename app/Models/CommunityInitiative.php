<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityInitiative extends Model
{
    use HasFactory;

    protected $table = 'community_initiative';
    
    protected $fillable = [
        'community_id',
        'judul',
        'deskripsi',
        'urutan_prioritas',
        'icon'
    ];

   
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'community_id');
    }
}
