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
        'author_id',
    ];

    public function cloquestion() :HasMany
    {
        return $this->hasMany(Cloquestion::class,'clo_id');
    }
}
