<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Whoops\Exception\ErrorException;

class CourseNavigation extends Component
{
    public Course $course;
    public string $location = 'information';
    public Collection $sections;
    protected $listeners = ['visibilityChanged' => 'render'];

    public function render()
    {
        $sections = $this->course->sections;
        if(Auth::user()->cannot('update', $this->course) || student()) {
            $sections->where('visible', true);
        }
        $this->sections = $sections->sortBy('order');
        return view('livewire.course-navigation');
    }

    public function updateSectionOrder(): void {
        try {
            $order = request()->updates[0]['payload']['params'][0];
            if(Auth::user()->can('update', $this->course)) {
                foreach ($order as $item) {
                    $section = Section::where('id', $item['value'])->first();
                    $section->order = (int) $item['order'];
                    $section->save();
                }
            }
            $this->emitTo('course-navigation', 'refresh');
        } catch(ErrorException $e) {
            Log::debug($e);
        }
        $this->course = Course::where('id', $this->course->id)->first();
    }
}
