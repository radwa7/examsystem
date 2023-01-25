<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'author_id'
    ];

    public function clo() :HasMany
    {
        return $this->hasMany(Clo::class,'subject_id');
    }
    public function subjectsassign() :HasMany
    {
        return $this->hasMany(Subjectsassign::class,'subject_id');
    }

    public function Exam() :HasMany
    {
        return $this->hasMany(Exam::class,'subject_id');
    }
}
