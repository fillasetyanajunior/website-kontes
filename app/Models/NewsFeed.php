<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'contest_id',
        'user_id_from',
        'user_id_to',
        'filecontest',
        'description',
        'rating',
        'feedback',
        'choices',
    ];
}
