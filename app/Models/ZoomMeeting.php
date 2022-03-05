<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'order',
        'section_id',
        'visible',
        'open',
        'due',
        'show_due_date',
    ];

    protected $casts = [
        'due' => 'datetime'
    ];
}
