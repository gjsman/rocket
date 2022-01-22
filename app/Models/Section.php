<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;
    use \App\Traits\Element;

    protected $fillable = ['name', 'short_summary', 'summary', 'course_id', 'visible', 'order'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function textBlocks(): HasMany
    {
        return $this->hasMany(TextBlock::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class);
    }
}
