<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'file',
        'order',
        'section_id',
        'visible'
    ];
}
