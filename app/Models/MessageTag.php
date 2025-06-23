<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTag extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_tag_id';

    protected $fillable = [
        'message_id',
        'user_id'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'message_id');
    }

    public function taggedUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}   
