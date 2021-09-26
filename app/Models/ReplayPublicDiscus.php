<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplayPublicDiscus extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_replay',
        'user_id',
        'feedback',
    ];
}
