<?php

namespace App\Models;

use App\Traits\Element;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    use Element;

    protected $fillable = [
        'name',
        'summary',
        'order',
        'section_id',
        'visible'
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(BookPage::class);
    }
}
