<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'order',
        'section_id',
        'gradeable_category_id',
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
        return $this->hasMany(AssignmentSubmission::class);
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

    public function gradeable_category(): BelongsTo
    {
        return $this->belongsTo(GradeableCategory::class);
    }
}
