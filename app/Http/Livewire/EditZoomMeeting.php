<?php

namespace App\Http\Livewire;

use App\Models\Section;
use App\Models\ZoomMeeting;
use Carbon\Carbon;
use Livewire\Component;
use Filament\Forms;

class EditZoomMeeting extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?ZoomMeeting $element = null;
    public Section $section;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'name' => $this->element->name,
                'summary' => $this->element->summary,
                'visible' => $this->element->visible,
                'open' => $this->element->open,
                'due' => $this->element->due,
                'show_due_date' => $this->element->show_due_date,
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
            Forms\Components\Checkbox::make('open')->default(true),
            Forms\Components\Checkbox::make('visible')->default(true),
            Forms\Components\DateTimePicker::make('due')->required()->default(Carbon::now()->addDays(14)),
            Forms\Components\Checkbox::make('show_due_date')->default(true),
        ];
    }

    public function submit()
    {
        if($this->element) {
            $this->element->update(
                $this->form->getState(),
            );
            return redirect()->route('course.location', ['course'=> $this->element->section->course, 'location' => $this->element->section]);
        } else {
            $values = $this->form->getState();
            $values['section_id'] = $this->section->id;
            $values['order'] = 1000;
            ZoomMeeting::create($values);
            return redirect()->route('course.location', ['course'=> $this->section->course, 'location' => $this->section]);
        }
    }

    public function render()
    {
        return view('livewire.edit-element', ['element' => $this->element]);
    }
}
