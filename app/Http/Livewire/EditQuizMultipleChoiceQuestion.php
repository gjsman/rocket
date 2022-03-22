<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\QuizMultipleChoiceQuestion;
use App\Models\QuizTrueFalseQuestion;
use App\Models\Section;
use App\Models\Video;
use Livewire\Component;
use Filament\Forms;

class EditQuizMultipleChoiceQuestion extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?QuizMultipleChoiceQuestion $element = null;
    public Quiz $quiz;

    public function mount(): void
    {
        if($this->element) {
            $this->form->fill([
                'name' => $this->element->name,
                'summary' => $this->element->summary,
                'visible' => $this->element->visible,
                'correct_answer' => $this->element->correct_answer,
                'choice1' => $this->element->choice1,
                'choice2' => $this->element->choice2,
                'choice3' => $this->element->choice3,
                'choice4' => $this->element->choice4,
                'choice5' => $this->element->choice5,
                'choice6' => $this->element->choice6,
                'choice7' => $this->element->choice7,
                'choice8' => $this->element->choice8,
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
            Forms\Components\Select::make('correct_answer')->options([
                1 => 'Choice 1',
                2 => 'Choice 2',
                3 => 'Choice 3',
                4 => 'Choice 4',
                5 => 'Choice 5',
                6 => 'Choice 6',
                7 => 'Choice 7',
                8 => 'Choice 8',
            ]),
            Forms\Components\TextInput::make('choice1')->required(),
            Forms\Components\TextInput::make('choice2')->nullable(),
            Forms\Components\TextInput::make('choice3')->nullable(),
            Forms\Components\TextInput::make('choice4')->nullable(),
            Forms\Components\TextInput::make('choice5')->nullable(),
            Forms\Components\TextInput::make('choice6')->nullable(),
            Forms\Components\TextInput::make('choice7')->nullable(),
            Forms\Components\TextInput::make('choice8')->nullable(),
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
            QuizMultipleChoiceQuestion::create($values);
            return redirect()->route('quiz', ['element'=> $this->quiz]);
        }
    }

    public function render()
    {
        return view('livewire.edit-element', ['element' => $this->element]);
    }
}
