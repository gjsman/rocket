<?php

namespace App\Models;

use App\Traits\QuizElement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTrueFalseQuestion extends Model
{
    use HasFactory;
    use QuizElement;

    protected $fillable = [
        'quiz_id',
        'name',
        'summary',
        'correct_answer',
        'visible',
    ];
}
