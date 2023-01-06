<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clo extends Model
{
    use HasFactory;

    protected $fillable = [
        'clo_name',
        'subject_id',
        'auhtor_id',
    ];
}
