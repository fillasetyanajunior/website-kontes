<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackBid extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'worker_id',
        'result_id',
        'feedback_customer',
        'feedback_worker',
    ];
}
