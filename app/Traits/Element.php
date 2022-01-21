<?php
namespace App\Traits;

use App\Models\Checkoff;
use App\Models\Student;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait Element {

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function item()
    {
        if (view()->exists(Str::snake(class_basename($this)).'/item')) {
            return view(Str::snake(class_basename($this)).'/item', ['element' => $this]);
        }
        return view('partials/no-element-view', ['element' => $this]);
    }

    /**
     * @return MorphMany Checkoff::class
     */
    public function checkoffs(): MorphMany
    {
        return $this->morphMany(Checkoff::class, 'checkoffable');
    }

    /**
     * @param bool $checked
     * @return bool
     */
    public function checkoff(bool $checked = true): bool
    {
        if(!student() && Auth::user()->rank === 1) return false;
        if(Auth::user()->rank > 1) {
            $checkoff = $this->checkoffs->where('user_id', Auth::id())->first();
        } else {
            $checkoff = $this->checkoffs->where('student_id', student()->id)->first();
        }
        if($checkoff === null) {
            $checkoff = new Checkoff;
            if (Auth::user()->rank > 1) {
                $checkoff->user_id = Auth::id();
            } else {
                $checkoff->student_id = student()->id;
            }
            $checkoff->checkoffable_id = $this->id;
            $checkoff->checkoffable_type = get_class($this);
        }
        $checkoff->checked = $checked;
        return $checkoff->save();
    }

    /**
     * @return bool
     */
    public function checked(): bool
    {
        if(!student() && Auth::user()->rank === 1) return false;
        if(Auth::user()->rank > 1) {
            $checkoff = $this->checkoffs->where('user_id', Auth::id())->first();
        } else {
            $checkoff = $this->checkoffs->where('student_id', student()->id)->first();
        }
        if($checkoff === null) return false;
        return $checkoff->checked;
    }
}
