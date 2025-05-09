<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'reference',
        'method',
        'amount',
        'status',
        'paid_at',
        'callback_response',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}