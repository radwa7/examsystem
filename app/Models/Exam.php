<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_id',
        'genration_type',
        'author_id',
        'semester',
        'code',
        'date',
        'year',
        'status',
        'total_score',
        'duration',
    ];

    // public function exam_question() :HasMany
    // {
    //     return $this->hasMany(ExamQuestion::class,'exam_id');
    // }
}
