<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizMultipleChoiceQuestion;
use App\Models\QuizTrueFalseQuestion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuizMultipleChoiceQuestionController extends Controller
{
    public function create(Quiz $quiz): Factory|View|Application
    {
        return view('course.edit-element', ['quiz' => $quiz, 'class' => QuizMultipleChoiceQuestion::class]);
    }

    public function edit(QuizMultipleChoiceQuestion $element): Factory|View|Application
    {
        return view('course.edit-element', ['element' => $element]);
    }

    public function delete(QuizMultipleChoiceQuestion $element): RedirectResponse
    {
        $quiz = $element->quiz;
        $element->delete();
        return redirect()->route('quiz', ['quiz' => $quiz]);
    }
}
