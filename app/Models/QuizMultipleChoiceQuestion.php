<?php

namespace App\Models;

use App\Traits\QuizElement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizMultipleChoiceQuestion extends Model
{
    use HasFactory;
    use QuizElement;

    protected $fillable = [
        'quiz_id',
        'name',
        'summary',
        'correct_answer',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'choice5',
        'choice6',
        'choice7',
        'choice8',
        'visible',
        'order',
    ];

    public function answers() {
        return $this->hasMany(QuizMultipleChoiceAnswer::class);
    }
}
