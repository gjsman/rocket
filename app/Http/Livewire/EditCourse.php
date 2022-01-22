<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Section;
use Filament\Forms;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditCourse extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Course $element;

    public function mount(): void
    {
        $this->form->fill([
            'name' => $this->element->name,
            'summary' => $this->element->summary,
            'short_summary' => $this->element->short_summary,
            'prerequisite' => $this->element->prerequisite,
            'instructor_access_link' => $this->element->instructor_access_link,
            'visible' => $this->element->visible,
            'show_instructor_access' => $this->element->show_instructor_access,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\RichEditor::make('summary')->required(),
            Forms\Components\TextInput::make('short_summary')->required(),
            Forms\Components\TextInput::make('prerequisite'),
            Forms\Components\RichEditor::make('instructor_access_link'),
            Forms\Components\Checkbox::make('show_instructor_access')->default(false),
            Forms\Components\Checkbox::make('visible')->default(true),
        ];
    }

    public function submit()
    {
        $this->element->update(
            $this->form->getState(),
        );
        return redirect()->route('course', ['course' => $this->element]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.edit-section');
    }
}
