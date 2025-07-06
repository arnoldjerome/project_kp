<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_detail',
        'file_url',
        'status',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
