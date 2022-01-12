<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

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
}
