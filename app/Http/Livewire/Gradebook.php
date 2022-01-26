<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Illuminate\Support\Collection;
use Livewire\Component;

class Gradebook extends Component
{
    public Course $course;
    public ?Collection $gradeables = null;
    public Collection $students;

    public function mount()
    {
        $this->gradeables = $this->course->gradeables();
        $this->students = new Collection;
        foreach($this->course->enrollments() as $enrollment) {
            $this->students[] = $enrollment->student;
        }
    }

    public function render()
    {
        return view('livewire.gradebook');
    }
}
