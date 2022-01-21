<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'url',
        'order',
        'section_id',
        'visible'
    ];
}
