<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use \App\Traits\Element;

    protected $fillable = [
        'name',
        'summary',
        'order',
        'section_id',
        'visible'
    ];
}
