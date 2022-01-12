<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShopIndex extends Component
{
    use WithPagination;

    protected $queryString = ['search', 'courseType', 'courseDifficulty', 'courseCategory'];

    public ?string $search = null;
    public int $courseType = 0;
    public int $courseDifficulty = 0;
    public int $courseCategory = 0;

    public function render()
    {
        $courses = Course::query();

        if ($this->search) {
            $courses->where('name', 'LIKE', '%'.$this->search.'%');
        } else {
            if ($this->courseCategory !== 0) $courses->where('category_id', $this->courseCategory);
            if ($this->courseDifficulty !== 0) $courses->where('difficulty', $this->courseDifficulty);
            if ($this->courseType === 3 || $this->courseType === 4) {
                if (Auth::check()) {
                    // if (!(Auth::user()->rank > 1)) $this->courseType = null;
                    $this->courseType = 0;
                } else {
                    $this->courseType = 0;
                }
            }
            if ($this->courseType !== 0) $courses->where('type', $this->courseType);
        }

        return view('shop.shop-index', [
            'courses' => $courses->paginate(12),
        ]);
    }
}
