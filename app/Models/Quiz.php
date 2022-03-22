<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'order',
        'section_id',
        'visible',
        'due',
        'allow_late_submissions',
        'show_due_date',
        'due_old',
    ];

    protected $casts = [
        'due' => 'datetime',
        'due_old' => 'datetime',
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(QuizSubmission::class);
    }

    public function canStartAttempt(): bool
    {
        return true;
    }

    public function inProgressSubmission(?Student $student = null, ?User $user = null): QuizSubmission|null
    {
        if($user === null) $user = Auth::user();
        if($student === null) $student = student();
        if($student) {
            return $this->submissions->where('student_id', $student->id)->where('submitted', false)->first();
        } elseif ($user && !$student) {
            return $this->submissions->where('user_id', $user->id)->where('submitted', false)->first();
        }
        return null;
    }

    public function attemptInProgress(?Student $student = null, ?User $user = null): bool
    {
        if($user === null) $user = Auth::user();
        if($student === null) $student = student();
        if($student) {
            return $this->submissions()->where('student_id', $student->id)->where('submitted', false)->exists();
        } elseif ($user && !$student) {
            return $this->submissions()->where('user_id', $user->id)->where('submitted', false)->exists();
        }
        return false;
    }

    public function hasSubmittedFile(?Student $student = null, ?User $user = null): bool|null
    {
        if($student) {
            return $this->submissions()->where('student_id', $student->id)->exists();
        } elseif ($user && !$student) {
            return $this->submissions()->where('user_id', $user->id)->exists();
        }
        return null;
    }

    public function trueFalse() {
        return $this->hasMany(QuizTrueFalseQuestion::class);
    }

    public function multipleChoice() {
        return $this->hasMany(QuizMultipleChoiceQuestion::class);
    }

}
