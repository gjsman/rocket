<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Collection;
use Livewire\Component;

class CourseNavigation extends Component
{
    public Course $course;
    public string $location = 'information';
    public Collection $sections;

    public function mount()
    {
        $sections = Section::query();
        $sections->where('course_id', $this->course->id);
        $this->sections = $sections->get();
    }

    public function render()
    {
        return view('livewire.course-navigation');
    }
}
