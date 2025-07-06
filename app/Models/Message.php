<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chat_id',
        'sender',
        'message',
        'timestamp',
        'is_hidden_by_admin',
        'is_hidden_by_admin_view',
    ];


    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}