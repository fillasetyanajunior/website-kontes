<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCountResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'result_contest_id',
        'user_id_worker',
        'choices',
    ];
}
