<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'summary',
        'short_summary',
        'category_id',
        'instructor_id',
        'type',
        'difficulty',
        'seats',
        'prerequisite',
        'instructor_access_link',
        'show_instructor_access',
        'start_time',
        'end_time',
        'counterpart_id',
        'price',
        'visible',
        'left_column_content',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function typeName (): string
    {
        if ((int) $this->type === 1) {
            return __('Live');
        } elseif ((int) $this->type === 2) {
            return __('Recorded');
        } elseif ((int) $this->type === 3) {
            return __('Archived');
        } elseif ((int) $this->type === 4) {
            return __('Developing');
        }
        return __('Error');
    }
    public function difficultyName (): string
    {
        if ((int) $this->type === 1) {
            return __('Elementary School');
        } elseif ((int) $this->type === 2) {
            return __('Middle School');
        } elseif ((int) $this->type === 3) {
            return __('High School');
        } elseif ((int) $this->type === 4) {
            return __('Adult Course');
        }
        return __('Error');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function enroll(?Student $student = null): bool {
        if(!$student) $student = student();
        if(!$student) return false;

        if(!Auth::user()->rank > 1) {
            if ($student->user_id !== Auth::id()) return false;
        }

        if ($this->type === 1) {
            // Live Course
            // TODO: Check for Order?
            return false;
        } elseif ($this->type === 2) {
            // Recorded Course
            if (!Auth::user()->sparkPlan()) return false;
        } elseif ($this->type === 3) {
            // Archived Course
            return false;
        } elseif ($this->type === 4) {
            // Developing Course
            return false;
        }

        $enrollment = Enrollment::where('course_id', $this->id)->where('student_id', $student->id)->first();

        if ($enrollment === NULL) {
            if ($this->type === 2) {
                Enrollment::firstOrCreate([
                    'course_id' => $this->id,
                    'student_id' => $student->id,
                ]);
                return true;
            }
        }

        return false;
    }

    public function unenroll(?Student $student = null): bool {
        if(!$student) $student = student();
        if(!$student) return false;

        if(!Auth::user()->rank > 1) {
            if ($student->user_id !== Auth::id()) return false;
        }

        if ($this->type !== 2) return false;

        $enrollment = Enrollment::where('course_id', $this->id)->where('student_id', $student->id)->first();

        if ($enrollment !== NULL) {
            return $enrollment->delete();
        }

        return false;
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function seatsRemaining(): int {
        $remaining = (int) $this->seats - (int) $this->orders()->count();
        if($remaining < 0) return 0;
        return $remaining;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function gradeables(): Collection
    {
        $sections = $this->sections->sortBy('order');
        $gradeables = new Collection;
        foreach ($sections as $section) {
            $elements = new Collection;
            if(Auth::user()->can('update', $this)) {
                $elements = $elements->merge($section->assignments);
                $elements = $elements->merge($section->quizzes);
            } else {
                $elements = $elements->merge($section->assignments->where('visible', true));
                $elements = $elements->merge($section->quizzes->where('visible', true));
            }
            $elements = $elements->sortBy('order');
            $gradeables = $gradeables->merge($elements);
        }
        return $gradeables;
    }
}
