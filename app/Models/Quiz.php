<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'due' => 'datetime'
    ];

    public function hasSubmittedFile(?Student $student = null, ?User $user = null): bool|null
    {
        /*
        if($student) {
            return $this->submissions()->where('student_id', $student->id)->exists();
        } elseif ($user && !$student) {
            return $this->submissions()->where('user_id', $user->id)->exists();
        } */
        return null;
    }
}
