<?php

namespace App\Http\Livewire;

use App\Models\QuizMultipleChoiceAnswer;
use App\Models\QuizMultipleChoiceQuestion;
use App\Models\QuizSubmission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditQuizMultipleChoiceForm extends Component
{
    public QuizMultipleChoiceQuestion $quizMultipleChoiceQuestion;
    public QuizSubmission $quizSubmission;
    public ?int $selected = null;

    public function mount()
    {
        if (!student()) {
            $quizMultipleChoiceQuestion = $this->quizMultipleChoiceQuestion->answers->where('user_id', Auth::id())->where('quiz_submission_id', $this->quizSubmission->id)->first();
        } else {
            $quizMultipleChoiceQuestion = $this->quizMultipleChoiceQuestion->answers->where('student_id', student()->id)->where('quiz_submission_id', $this->quizSubmission->id)->first();
        }
        if ($quizMultipleChoiceQuestion !== null) {
            $this->selected = $quizMultipleChoiceQuestion->selection;
        }
    }

    public function setSelection(int $value)
    {
        if (!student()) {
            $quizMultipleChoiceAnswer = $this->quizMultipleChoiceQuestion->answers->where('user_id', Auth::id())->where('quiz_submission_id', $this->quizSubmission->id)->first();
        } else {
            $quizMultipleChoiceAnswer = $this->quizMultipleChoiceQuestion->answers->where('student_id', student()->id)->where('quiz_submission_id', $this->quizSubmission->id)->first();
        }
        if ($quizMultipleChoiceAnswer === null) {
            $quizMultipleChoiceAnswer = new QuizMultipleChoiceAnswer;
            if (!student()) {
                $quizMultipleChoiceAnswer->user_id = Auth::id();
            } else {
                $quizMultipleChoiceAnswer->student_id = student()->id;
            }
            $quizMultipleChoiceAnswer->quiz_multiple_choice_question_id = $this->quizMultipleChoiceQuestion->id;
            $quizMultipleChoiceAnswer->quiz_submission_id = $this->quizSubmission->id;
        }
        $quizMultipleChoiceAnswer->selection = $value;
        $quizMultipleChoiceAnswer->save();
        $this->selected = $quizMultipleChoiceAnswer->selection;
    }

    public function render()
    {
        return view('livewire.edit-quiz-multiple-choice-form');
    }
}

