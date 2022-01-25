<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Grade extends Model
{
    use HasFactory;

    public function gradeable(): MorphTo
    {
        return $this->morphTo();
    }
}
