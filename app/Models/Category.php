<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'visible', 'updated_at', 'created_at'];

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
