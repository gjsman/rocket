<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'student_id',
        'user_id',
        'assignment_id',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function parent(): BelongsTo
    {
        return $this->assignment();
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grade(): MorphOne
    {
        return $this->morphOne(Grade::class, 'gradeable');
    }
}
