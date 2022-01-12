<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class InstructorIndex extends Component
{
    public ?string $search = null;
    protected $queryString = ['search'];

    public function render()
    {
        $instructors = User::query();
        $instructors->where('rank', '=', 3);

        if ($this->search) {
            $instructors->where('name', 'LIKE', '%'.$this->search.'%');
        }

        return view('instructors.instructor-index', [
            'instructors' => $instructors->paginate(9),
        ]);
    }
}
