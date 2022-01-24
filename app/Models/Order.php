<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'price',
        'charge_id',
        'charge_created',
        'payment_intent',
        'receipt_email',
        'receipt_url',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'charge_created' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return HasOne
     */
    public function enrollment(): HasOne {
        return $this->hasOne(Enrollment::class);
    }

    /**
     * @return bool
     */
    public function assigned(): bool
    {
        return $this->enrollment()->exists();
    }
}
