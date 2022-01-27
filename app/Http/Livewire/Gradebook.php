<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Illuminate\Support\Collection;
use Livewire\Component;

class Gradebook extends Component
{
    public Course $course;
    public Collection $gradeables;

    public function mount()
    {
        $this->gradeables = $this->course->gradeables();
    }

    public function render()
    {
        return view('livewire.gradebook');
    }
}
