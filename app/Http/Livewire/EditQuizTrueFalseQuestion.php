<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\QuizTrueFalseQuestion;
use App\Models\Section;
use App\Models\Video;
use Livewire\Component;
use Filament\Forms;

class EditQuizTrueFalseQuestion extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?QuizTrueFalseQuestion $element = null;
public Quiz $quiz;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'name' => $this->element->name,
                'summary' => $this->element->summary,
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
            Forms\Components\Checkbox::make('visible')->default(true),
        ];
    }

    public function submit()
    {
        if($this->element) {
            $this->element->update(
                $this->form->getState(),
            );
            return redirect()->route('quiz', ['element'=> $this->element->quiz->section->course]);
        } else {
            $values = $this->form->getState();
            $values['quiz_id'] = $this->quiz->id;
            $values['order'] = 1000;
            QuizTrueFalseQuestion::create($values);
            return redirect()->route('quiz', ['element'=> $this->quiz]);
        }
    }

    public function render()
    {
        return view('livewire.edit-element', ['element' => $this->element]);
    }
}
