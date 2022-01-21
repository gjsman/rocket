<?php

namespace App\Http\Livewire;

use App\Models\Link;
use App\Models\Section;
use App\Models\Video;
use Livewire\Component;
use Filament\Forms;

class EditLink extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?Link $element = null;
    public Section $section;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'name' => $this->element->name,
                'summary' => $this->element->summary,
                'url' => $this->element->url,
                'visible' => $this->element->visible,
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
            Forms\Components\TextInput::make('url')->label('URL')->required(),
            Forms\Components\Checkbox::make('visible')->default(true),
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
            Link::create($values);
            return redirect()->route('course.location', ['course'=> $this->section->course, 'location' => $this->section]);
        }
    }

    public function render()
    {
        return view('livewire.edit-element', ['element' => $this->element]);
    }
}
