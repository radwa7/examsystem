<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloquestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'clo_id',
        'question_id',
    ];
}
