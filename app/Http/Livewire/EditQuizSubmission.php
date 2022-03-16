<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\QuizSubmission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditQuizSubmission extends Component
{
    public ?QuizSubmission $element = null;
    public Quiz $quiz;
    public bool $quizStarted = false;
    public ?Collection $elements = null;

    public function render()
    {
        return view('livewire.edit-quiz-submission');
    }

    public function startQuiz()
    {
        if($this->quiz->attemptInProgress()) {
            $this->element = $this->quiz->inProgressSubmission();
            $this->quizStarted = true;
        } else {
            if($this->quiz->canStartAttempt()) {
                $submission = new QuizSubmission;
                if(student()) {
                    $submission->student_id = student()->id;
                } else {
                    $submission->user_id = Auth::id();
                }
                $submission->quiz_id = $this->quiz->id;
                $submission->save();
                $this->element = $submission;
                $this->quizStarted = true;
            }
        }
        if(Auth::user()->can('update', $this->quiz)) {
            $trueFalse = $this->quiz->trueFalse;
        } else {
            $trueFalse = $this->quiz->trueFalse->where('visible', true);
        }
        $elements = new Collection;
        $elements = $elements->merge($trueFalse);
        $this->elements = $elements->sortBy('order');
    }

    public function submitQuiz() {
        if($this->quiz->attemptInProgress()) {
            if($this->quiz->inProgressSubmission()->id === $this->element->id) {
                $this->element->submitted = true;
                $this->element->save();
                $this->quizStarted = false;
                $this->quiz = Quiz::where('id', $this->quiz->id)->first();
            }
        }
    }
}
