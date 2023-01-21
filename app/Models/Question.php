<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'subject_id',
        'level',
        'author_id',
        'answer_type',
    ];

    public function cloquestion() :HasMany
    {
        return $this->hasMany(Cloquestion::class,'question_id');
    }
    public function textanswer() :HasMany
    {
        return $this->hasMany(Textanswer::class,'question_id');
    }
    public function mcqanswer() :HasMany
    {
        return $this->hasMany(Mcqanswer::class,'question_id');
    }
}
