<?php

namespace App\Http\Livewire;

use App\Models\Checkoff;
use App\Models\QuizSubmission;
use App\Models\QuizTrueFalseAnswer;
use App\Models\QuizTrueFalseQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditQuizTrueFalseQuestionForm extends Component
{
    public QuizTrueFalseQuestion $quizTrueFalseQuestion;
    public QuizSubmission $quizSubmission;
    public ?bool $selected = null;

    public function mount()
    {
        if (!student()) {
            $quizTrueFalseAnswer = $this->quizTrueFalseQuestion->answers->where('user_id', Auth::id())->where('quiz_submission_id', $this->quizSubmission->id)->first();
        } else {
            $quizTrueFalseAnswer = $this->quizTrueFalseQuestion->answers->where('student_id', student()->id)->where('quiz_submission_id', $this->quizSubmission->id)->first();
        }
        if ($quizTrueFalseAnswer !== null) {
            $this->selected = $quizTrueFalseAnswer->selection;
        }
    }

    public function setSelection(bool $value) {
        if(!student()) {
            $quizTrueFalseAnswer = $this->quizTrueFalseQuestion->answers->where('user_id', Auth::id())->where('quiz_submission_id', $this->quizSubmission->id)->first();
        } else {
            $quizTrueFalseAnswer = $this->quizTrueFalseQuestion->answers->where('student_id', student()->id)->where('quiz_submission_id', $this->quizSubmission->id)->first();
        }
        if($quizTrueFalseAnswer === null) {
            $quizTrueFalseAnswer = new QuizTrueFalseAnswer;
            if (!student()) {
                $quizTrueFalseAnswer->user_id = Auth::id();
            } else {
                $quizTrueFalseAnswer->student_id = student()->id;
            }
            $quizTrueFalseAnswer->quiz_true_false_question_id = $this->quizTrueFalseQuestion->id;
            $quizTrueFalseAnswer->quiz_submission_id = $this->quizSubmission->id;
        }
        $quizTrueFalseAnswer->selection = $value;
        $quizTrueFalseAnswer->save();
        $this->selected = $quizTrueFalseAnswer->selection;
    }

    public function render()
    {
        return view('livewire.edit-quiz-true-false-question-form');
    }
}
