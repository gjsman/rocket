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
}
