<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizTrueFalseAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_true_false_question_id',
        'quiz_submission_id',
        'user_id',
        'student_id',
        'selection',
    ];

    public function quiz_submission() {
        return $this->belongsTo(QuizSubmission::class);
    }

    public function quiz_true_false_question() {
        return $this->belongsTo(QuizTrueFalseQuestion::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
