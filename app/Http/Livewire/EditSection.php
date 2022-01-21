<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Section;
use Filament\Forms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditSection extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?Section $section = null;
    public Course $course;

    public function mount(): void
    {
        if($this->section) {
            $this->form->fill([
                'name' => $this->section->name,
                'summary' => $this->section->summary,
                'visible' => $this->section->visible,
            ]);
        } else {
            $this->form->fill();
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\RichEditor::make('summary'),
            Forms\Components\Checkbox::make('visible')->default(true),
        ];
    }

    public function submit()
    {
        if($this->section) {
            $this->section->update(
                $this->form->getState(),
            );
            return redirect()->route('course.location', ['course'=> $this->section->course, 'location' => $this->section]);
        } else {
            $values = $this->form->getState();
            $values['course_id'] = $this->course->id;
            $values['order'] = 1000;
            $newSection = Section::create($values);
            return redirect()->route('course.location', ['course'=> $this->course, 'location' => $newSection]);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.edit-section');
    }
}
